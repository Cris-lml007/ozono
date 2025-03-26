<?php

namespace App\Livewire;

use App\Models\History;
use Carbon\Carbon;
use Livewire\Component;

class ReportAppointment extends Component
{

    public $date_start;
    public $date_end;
    public $search;

    public function mount(){
        $this->date_start = Carbon::now()->toDateString();
        $this->date_end = Carbon::now()->toDateString();
    }

    public function render()
    {

        if(!empty($this->search)){
            $data = History::whereHas('reservation',function($query){
                $query->where('date','>=',$this->date_start)->where('date','<=',$this->date_end);
            })->whereHas('person',function($query){
                $query->where('name','like','%'.$this->search.'%')->orWhere('surname','like','%'.$this->search.'%');
            })->get();
            $total = 0;
            return view('livewire.report-appointment',compact('data','total'));
        }
        $data = History::whereHas('reservation',function($query){
            $query->where('date','>=',$this->date_start)->where('date','<=',$this->date_end);
        })->get();
        $total = 0;
        return view('livewire.report-appointment',compact('data','total'));
    }
}
