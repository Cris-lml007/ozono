<?php

namespace App\Livewire;

use App\Models\Schedule;
use App\Models\Setting;
use App\Models\Treatment;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Schedules extends Component
{
    public $schedules;
    public $daySelects = [];
    #[Validate('required|date_format:H:i')]
    public $start;
    #[Validate('required|date_format:H:i|after:start')]
    public $end;

    public $treatment;
    public $first_free;

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
        $this->treatment = Setting::first()->treatment_id;
        $this->first_free = Setting::first()->first_free;
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

    public function getTreatments(){
        return Treatment::all();
    }

    public function updatedTreatment(){
        if($this->treatment != null){
            Setting::first()->update(['treatment_id' => $this->treatment]);
        }else{
            Setting::first()->update(['treatment_id' => null]);
        }
    }

    public function updatedFirstFree(){
        Setting::first()->update(['first_free' => $this->first_free]);
    }

    public function restart(){
        $this->reset(['start','end']);
    }

    public function render()
    {
        return view('livewire.schedules');
    }
}
