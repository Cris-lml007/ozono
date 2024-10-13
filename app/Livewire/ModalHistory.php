<?php

namespace App\Livewire;

use App\Models\Detail_diagnostic;
use App\Models\Detail_treatment;
use Carbon\Carbon;
use Livewire\Component;

class ModalHistory extends Component
{
    public $presure;
    public $temperature;
    public $respiratory_rate;
    public $heart_rate;
    public $evaluation;

    public $weight;
    public $height;
    public $imc;
    public $imcStatus;

    public $id;
    public $histories;
    public $pos = 0;
    public $date;
    public $schedule_time;
    public $canceled;

    public $listeners = ['treatment_id' => 'getTreatment'];

    public function getTreatment($id){
        $this->id = $id;
        $this->loadData();
    }

    public function loadData(){
        $this->histories = Detail_diagnostic::find($this->id)->histories;
        $this->presure = $this->histories[$this->pos]->presure;
        $this->temperature = $this->histories[$this->pos]->temperature;
        $this->heart_rate = $this->histories[$this->pos]->heart_rate;
        $this->respiratory_rate = $this->histories[$this->pos]->respiratory_rate;
        $this->weight = $this->histories[$this->pos]->weight;
        $this->height = $this->histories[$this->pos]->height;
        $this->date = $this->histories[$this->pos]->updated_at->toDateString();
        // return dd($this->date);
        $this->schedule_time = $this->histories[$this->pos]->reservation->staffSchedule->schedule->start.'-'.$this->histories[$this->pos]->reservation->staffSchedule->schedule->end;
        $this->getIMC();
        $this->evaluation = $this->histories[$this->pos]->description;
        $this->canceled = $this->histories[$this->pos]->canceled;
    }

    public function next(){
        if($this->pos+1 < sizeof($this->histories)){
            $this->pos++;
            $this->loadData();
        }
    }

    public function prev(){
        if($this->pos-1 >0){
            $this->pos--;
            $this->loadData();
        }
    }


    public function getIMC()
    {
        if (empty($this->weight) or empty($this->height)) {
            $this->imc = null;
            $this->imcStatus = null;
            return;
        }
        $this->imc = ($this->weight ?? 1) / pow($this->height / 100, 2);
        if ($this->imc < 18.5) {
            $this->imcStatus =  "Bajo peso";
        } elseif ($this->imc >= 18.5 && $this->imc < 24.9) {
            $this->imcStatus =  "Peso normal";
        } elseif ($this->imc >= 25 && $this->imc < 29.9) {
            $this->imcStatus =  "Sobrepeso";
        } else {
            $this->imcStatus =  "Obesidad";
        }
    }


    public function render()
    {
        return view('livewire.modal-history');
    }
}
