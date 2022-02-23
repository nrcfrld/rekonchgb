<?php

namespace App\Http\Livewire;

use App\Models\BankIdentifierNumber;
use Livewire\Component;

class CreateBankIdentifierNumber extends Component
{
    public $bankIdentifierNumber;
    public $bankIdentifierNumberId;
    public $action;
    public $button;

    protected function getRules()
    {
        return [
            'bankIdentifierNumber.code' => 'required|min:3',
            'bankIdentifierNumber.name' => 'required|min:3'
        ];
    }

    public function createBankIdentifierNumber ()
    {
        $this->resetErrorBag();
        $this->validate();

        BankIdentifierNumber::create($this->bankIdentifierNumber);

        $this->emit('saved');
        $this->reset('bankIdentifierNumber');
    }

    public function updateBankIdentifierNumber ()
    {
        $this->resetErrorBag();
        $this->validate();

        BankIdentifierNumber::query()
            ->where('id', $this->bankIdentifierNumberId)
            ->update([
                "name" => $this->bankIdentifierNumber->name,
                "descriptions" => $this->bankIdentifierNumber->descriptions,
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->bankIdentifierNumber && $this->bankIdentifierNumberId) {
            $this->bankIdentifierNumber = BankIdentifierNumber::find($this->bankIdentifierNumberId);
        }

        $this->button = create_button($this->action, "BankIdentifierNumber");
    }

    public function render()
    {
        return view('livewire.bank-identifier-number.create');
    }
}
