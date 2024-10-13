<?php

namespace App\Livewire;

use App\Models\Reservation;
use Carbon\Carbon;
use Livewire\Component;

class WaitingQueue extends Component
{

    public function reservations(){
        return Reservation::where('date',Carbon::now()->toDateString())->get();
    }

    public function runConsultation($id){
        return redirect(route('dashboard.consultation',$id));
    }

    public function render()
    {
        return view('livewire.waiting-queue');
    }
}
