<?php

namespace App\Http\Livewire;

use App\Models\Principal;
use App\Models\ReasonCode;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateReasonCode extends Component
{
    public $reasonCode;
    public $reasonCodeId;
    public $action;
    public $button;

    protected function getRules()
    {
        return [
            'reasonCode.principal_id' => 'required',
            'reasonCode.code' => 'required',
            'reasonCode.name' => 'required|min:3',
        ];
    }

    public function createReasonCode()
    {
        $this->resetErrorBag();
        $this->validate();

        ReasonCode::create($this->reasonCode);

        $this->emit('saved');
        $this->reset('reasonCode');
    }

    public function updateReasonCode()
    {
        $this->resetErrorBag();
        $this->validate();

        ReasonCode::query()
            ->where('id', $this->reasonCodeId)
            ->update([
                "name" => $this->reasonCode->name,
                "code" => $this->reasonCode->code,
                "principal_id" => $this->reasonCode->principal_id
            ]);

        $this->emit('saved');
    }

    public function mount()
    {
        if (!$this->reasonCode && $this->reasonCodeId) {
            $this->reasonCode = ReasonCode::find($this->reasonCodeId);
        }

        $this->button = create_button($this->action, "ReasonCode");
    }

    public function render()
    {
        $principals = Principal::all();
        return view('livewire.create-reason-code', compact('principals'));
    }
}
