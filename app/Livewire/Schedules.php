<?php

namespace App\Livewire;

use App\Models\Schedule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Schedules extends Component
{
    public $schedules;
    public $daySelects = [];
    #[Validate('required|date_format:H:i|after:06:00')]
    public $start;
    #[Validate('required|date_format:H:i|after:start')]
    public $end;

    public function toggleDays($day)
    {
        if (!in_array($day, $this->daySelects)) {
            $this->daySelects[] = $day;
        } else {
            $this->daySelects = array_diff($this->daySelects, [$day]);
        }
    }


    public function boot()
    {
        $this->schedules = Schedule::all();
    }

    public function getDays($day)
    {
        return Schedule::where('day', $day)->orderBy('start', 'asc')->get();
    }

    public function save()
    {
        $this->validate();
        $data = [];
        foreach ($this->daySelects as $day) {
            $data[] = [
                'day' => $day,
                'start' => $this->start,
                'end' => $this->end
            ];
        }
        // Schedule::insert($data);
        Schedule::upsert($data,['start','day'],['start','end']);
        $this->restart();
    }

    public function delete($id){
        Schedule::destroy($id);
    }

    public function restart(){
        $this->reset(['start','end']);
    }

    public function render()
    {
        return view('livewire.schedules');
    }
}
