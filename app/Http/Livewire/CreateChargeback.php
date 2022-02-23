<?php

namespace App\Http\Livewire;

use App\Enums\StatusType;
use App\Models\Chargeback;
use App\Models\Level;
use App\Models\Principal;
use App\Models\ReasonCode;
use Livewire\Component;

class CreateChargeback extends Component
{
    public $chargeback;
    public $chargebackId;
    public $action;
    public $button;

    protected function getRules()
    {
        $rules = ($this->action == "updateChargeback") ? [
            'chargeback.ref_id' => 'required|unique:chargebacks,ref_id,' . $this->chargebackId
        ] : [];

        return array_merge([
            'chargeback.ref_id' => 'required|unique:chargebacks,ref_id',
            'chargeback.arn' => 'required|min:3',
            'chargeback.card_number' => 'required',
            'chargeback.approval_code' => 'required',
            'chargeback.amount' => 'required',
            'chargeback.status' => 'required',
            'chargeback.opencase_date' => 'required',
            'chargeback.expired_date' => 'required',
            'chargeback.transaction_date' => 'required',
            'chargeback.principal_id' => 'required',
            'chargeback.level_id' => 'required',
            'chargeback.reason_code_id' => 'required',
            'chargeback.merchant' => 'required',
            'chargeback.mid' => 'required',
            'chargeback.tid' => 'required',
        ], $rules);
    }

    public function createChargeback()
    {
        // dd($this->chargeback);
        $this->resetErrorBag();
        $this->validate();
        // dd($this->chargeback);

        Chargeback::create($this->chargeback);

        $this->emit('saved');
        $this->reset('chargeback');
    }

    public function updateChargeback()
    {
        $this->resetErrorBag();
        $this->validate();

        $this->chargeback->save();

        $this->emit('saved');
    }

    public function mount()
    {
        if (!$this->chargeback && $this->chargebackId) {
            $this->chargeback = Chargeback::find($this->chargebackId);
        }

        $this->button = create_button($this->action, "Chargeback");
    }

    public function render()
    {
        $levels = Level::all();
        $principals = Principal::all();
        $reasonCodes = ReasonCode::all();
        $status = StatusType::getValues();


        return view('livewire.chargeback.create', compact('levels', 'reasonCodes', 'principals', 'status'));
    }
}
