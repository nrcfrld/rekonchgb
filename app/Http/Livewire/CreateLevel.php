<?php

namespace App\Http\Livewire;

use App\Models\Level;
use Livewire\Component;

class CreateLevel extends Component
{
    public $level;
    public $levelId;
    public $action;
    public $button;

    protected function getRules()
    {
        return [
            'level.name' => 'required|min:3',
            'level.descriptions' => 'required'
        ];
    }

    public function createLevel ()
    {
        $this->resetErrorBag();
        $this->validate();

        Level::create($this->level);

        $this->emit('saved');
        $this->reset('level');
    }

    public function updateLevel ()
    {
        $this->resetErrorBag();
        $this->validate();

        Level::query()
            ->where('id', $this->levelId)
            ->update([
                "name" => $this->level->name,
                "descriptions" => $this->level->descriptions,
            ]);

        $this->emit('saved');
    }

    public function mount ()
    {
        if (!$this->level && $this->levelId) {
            $this->level = Level::find($this->levelId);
        }

        $this->button = create_button($this->action, "Level");
    }

    public function render()
    {
        return view('livewire.level.create');
    }
}
