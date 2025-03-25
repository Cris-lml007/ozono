<?php

namespace App\Livewire;

use App\Models\Diagnostic;
use App\Models\History;
use App\Models\Person;
use Carbon\Carbon;
use Livewire\Component;

class HistoryPatient extends Component
{
    Public Person $person;
    public $ci;
    public $surname;
    public $name;
    public $gender;
    public $birthdate;
    public $allergies;
    public $surgeries;
    public $pathological;

    public $body_pain;
    public $open_diagnostic;

    public $diagnostic;
    public $detail_diagnostic;
    public $diagnostics = [];

    public $consultation;
    public $disease;
    public $physicalExam;

    public $total;
    public $canceled;

    public $treatment_id;

    public function selectTreatment($id){
        if(History::where('detail_diagnostic_id',$id)->exists()){
            $this->dispatch('treatment_id',$id);
            $this->dispatch('openModal');
        }
    }

    public function mount(Person $person){
        $this->person = $person;
        $this->ci = $person->ci;
        $this->surname = $person->surname;
        $this->name = $person->name;
        $this->birthdate = Carbon::now()->year - Carbon::parse($person->birthdate)->year;
        $this->gender = $person->gender == 1 ? 'Hombre' : 'Mujer';
        $this->allergies = $person->allergies;
        $this->surgeries = $person->surgeries;
        $this->pathological = $person->pathological;
        $this->diagnostics = $person->diagnostics();
    }

    public function getDiagnostic($id){
        $this->diagnostic = Diagnostic::find($id);
        $this->detail_diagnostic = $this->diagnostic->description;
        $this->diagnostic->detail_diagnostic;

        $this->detail_diagnostic = $this->diagnostic->description;
        $this->body_pain = explode(',',$this->diagnostic->body_pain);
        $this->consultation = $this->diagnostic->consultation;
        $this->disease = $this->diagnostic->disease;
        $this->physicalExam = $this->diagnostic->physicalExam;
        // $this->subjetive_intensity = $this->diagnostic->subjetive_intensity;
        $this->total = $this->diagnostic->detail_diagnostics()->selectRaw('SUM(price * quantity) as total')->value('total');
        // $this->reservations = Reservation::where('person_id',$this->reservation->person_id)->where('date','>=',Carbon::now())->whereHas('staffSchedule',function ($query){
        //     $query->where('user_id',Auth::user()->id);
        // })->get();
        foreach(History::where('person_id',$this->person->id)->get() as $history){
            if($history->detailDiagnostic->diagnostic_id == $this->diagnostic->id){
                $this->total -= $history->canceled;
                $this->canceled += $history->canceled;
            }
        }

        $this->openDiagnostic();
    }

    public function countTreatment($detail_id){
        return $this->person->history()->where('detail_diagnostic_id',$detail_id)->count();
    }

    public function openDiagnostic(){
        $this->open_diagnostic = true;
    }

    public function closeDiagnostic(){
        $this->open_diagnostic = false;
    }

    public function render(){
        return view('livewire.history-patient');
    }
}
