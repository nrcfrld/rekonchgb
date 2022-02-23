<?php

namespace App\Http\Livewire;

use App\Models\Principal;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreatePrincipal extends Component
{
    public $principal;
    public $principalId;
    public $action;
    public $button;

    protected function getRules()
    {
        return [
            'principal.name' => 'required',
            'principal.descriptions' => 'required'
        ];
    }

    public function createPrincipal()
    {
        $this->resetErrorBag();
        $this->validate();

        Principal::create($this->principal);

        $this->emit('saved');
        $this->reset('principal');
    }

    public function updatePrincipal()
    {
        $this->resetErrorBag();
        $this->validate();

        Principal::query()
            ->where('id', $this->principalId)
            ->update([
                "name" => $this->principal->name,
                "descriptions" => $this->principal->descriptions,
            ]);

        $this->emit('saved');
    }

    public function mount()
    {
        if (!$this->principal && $this->principalId) {
            $this->principal = Principal::find($this->principalId);
        }

        $this->button = create_button($this->action, "Principal");
    }

    public function render()
    {
        return view('livewire.create-principal');
    }
}
