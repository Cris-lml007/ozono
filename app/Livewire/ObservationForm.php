<?php

namespace App\Livewire;

use App\Enums\Type;
use App\Models\Observation;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ObservationForm extends Component
{
    public $idOb;

    #[Validate('required')]
    public $name;

    #[validate('required')]
    public $type;

    public Observation $observation;

    protected $listeners = ['observationEdit' => 'getObservation'];

    public function getObservation($id){
        $this->observation = Observation::find($id);
        $this->idOb = $this->observation->id;
        $this->name = $this->observation->name;
        $this->type = $this->observation->type==Type::CONTRAIN->display() ? 0 : 1;
        $this->validate();
    }

    public function updateOrCreate(){
        $this->validate();
        Observation::updateOrCreate(
            [
                'name' => $this->name
            ],
            [
                'type' => $this->type==0 ? Type::CONTRAIN : Type::EFFECT
            ]
        );
        $this->reset();
    }

    public function restart(){
        $this->reset();
    }

    public function render()
    {
        $this->dispatch('update');
        return view('livewire.observation-form');
    }
}
