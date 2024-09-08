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

    public function runConsultation(){
        return redirect(route('dashboard.consultation'));
    }

    public function render()
    {
        return view('livewire.waiting-queue');
    }
}
