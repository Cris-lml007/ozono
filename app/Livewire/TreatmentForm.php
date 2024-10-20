<?php

namespace App\Livewire;

use App\Models\Detail_treatment;
use App\Models\Observation;
use App\Models\Treatment;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TreatmentForm extends Component
{
    //Tratamiento
    public $idT;

    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $description;

    #[Validate('required')]
    public $price;

    public $observations;
    public $selectObservation;

    public Treatment $treatment;
    //Lista de Observaciones
    public $listOb = [];

    protected $listeners = ['treatmentEdit' => 'getTreatment','showDeleteConfirmation'];

    public function confirmDelete(){
        $this->dispatch('showDeleteConfirmation');
    }


    public function messages(): array
    {
        return [
            'selectObservation.integer' => 'Seleccione Uno.',
        ];
    }

    public function getTreatment($id){
        $this->treatment = Treatment::find($id);
        $this->idT = $this->treatment->id;
        $this->name = $this->treatment->name;
        $this->description = $this->treatment->description;
        $this->price = $this->treatment->price;
        $this->observations = $this->treatment->observations;
        $this->listOb = Observation::all();
        $this->validate();
    }

    public function deleteObservation($id){
        $this->treatment->observations()->detach($id);
        $this->getTreatment($this->treatment->id);
    }

    public function deleteTreatment(){
        Treatment::destroy($this->treatment->id);
        $this->reset();
    }

    public function addObservation(){
        $this->validate([
            'selectObservation' => 'integer'
        ]);
        Detail_treatment::firstOrCreate([
            'treatment_id' => $this->idT,
            'observation_id' => $this->selectObservation
        ]);
        $this->getTreatment($this->treatment->id);
    }

    public function updateOrCreate(){
        $this->validate();
        $treatment = Treatment::updateOrCreate(
            [
                'id' => $this->idT
            ],[
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price
            ]
        );
        $this->getTreatment($treatment->id);
    }

    public function restart(){
        $this->reset();
    }

    public function render()
    {
        $this->dispatch('update');
        return view('livewire.treatment-form');
    }
}
