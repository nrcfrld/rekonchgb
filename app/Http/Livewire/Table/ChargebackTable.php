<?php

namespace App\Http\Livewire\Table;

use App\Enums\StatusType;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class ChargebackTable extends Component
{
    use WithPagination;

    public $urgentOnly;

    public $model;
    public $name;

    public $perPage = 10;
    public $sortField = "created_at";
    public $sortAsc = true;
    public $search = '';

    public $ref_id = null;
    public $arn = null;
    public $status = null;
    public $level_id = null;
    public $card_number = null;
    public $reason_code_id = null;
    public $principal_id = null;
    public $start_date = null;
    public $end_date = null;

    protected $queryString = ['principal_id', 'ref_id', 'arn', 'status', 'level_id', 'reason_code_id', 'start_date', 'end_date'];

    protected $listeners = ["deleteItem" => "delete_item"];

    public function mount()
    {
        $this->arn = request()->arn;
        $this->card_number = request()->card_number;
        $this->ref_id = request()->ref_id;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function delete_item($id)
    {
        $data = $this->model::find($id);

        if (!$data) {
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data " . $this->name
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data " . $this->name . " berhasil dihapus!"
        ]);
    }

    public function render()
    {
        $data = $this->model::search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->with(['principal', 'reasonCode', 'level', 'createdBy', 'updatedBy']);

        if ($this->urgentOnly) {
            $date = date("Y-m-d");
            $toDate = date("Y-m-d", strtotime($date . ' + 7 days'));
            $data = $data->whereBetween('expired_date', [$date, $toDate])->where('status', StatusType::Open);
        }

        if ($this->principal_id) {
            $data = $data->where('principal_id', $this->principal_id);
        }

        if ($this->ref_id) {
            $data = $data->where('ref_id', $this->ref_id);
        }

        if ($this->card_number) {
            $data = $data->where('card_number', $this->card_number);
        }

        if ($this->arn) {
            $data = $data->where('arn', $this->arn);
        }

        if ($this->level_id) {
            $data = $data->where('level_id', $this->level_id);
        }

        if ($this->status) {
            $data = $data->where('status', $this->status);
        }

        if ($this->start_date) {
            $data = $data->whereDate('opencase_date', '>=', $this->start_date);
        }

        if ($this->end_date) {
            $data = $data->whereDate('opencase_date', '<=', $this->end_date);
        }

        return view('livewire.chargeback.index', [
            "view" => 'livewire.chargeback.index',
            "chargebacks" => $data->paginate($this->perPage),
            "data" => array_to_object([
                'href' => [
                    'create_new' => route('chargeback.new'),
                    'create_new_text' => 'Buat Data Baru',
                    'export' => route('chargeback.export', request()->all()),
                    'export_text' => $this->urgentOnly ? false : 'Export'
                ]
            ])
        ]);
    }
}
