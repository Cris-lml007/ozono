<?php

namespace App\Livewire;

use App\Models\History;
use Carbon\Carbon;
use Livewire\Component;

class ReportIncome extends Component
{
    public $date_start;
    public $date_end;

    public function mount(){
        $this->date_start = Carbon::now()->toDateString();
        $this->date_end = Carbon::now()->toDateString();
    }
    public function render()
    {
        $data = History::whereHas('reservation',function($query){
            $query->where('date','>=',$this->date_start)->where('date','<=',$this->date_end);
        })->get();
        $total = 0;
        return view('livewire.report-income',compact('data','total'));
    }
}
