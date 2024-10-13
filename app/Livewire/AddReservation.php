<?php

namespace App\Livewire;

use App\Enums\Role;
use App\Models\Person;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Staff_schedule;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddReservation extends Component
{
    public $date;
    #[Validate('integer|min:1|max:6')]
    public $day;
    public $hour;
    public $medic;

    public $person;
    public $ci;

    public function rules(){
        return [
            'medic' => [
                'required',
                Rule::unique('reservations','staff_schedule_id')->where(fn(Builder $query) => $query->where('date',$this->date))
            ]
        ];
    }

    public function getHours()
    {
        return Schedule::where('day', $this->day)->get();
    }

    public function createAttention()
    {
        $this->validate();
        Reservation::create([
            'person_id' => $this->person->id,
            'staff_schedule_id' => $this->medic,
            'date' => $this->date
        ]);
        return redirect(route('dashboard.main'));
    }

    public function getMedics()
    {
        return Staff_schedule::where('schedule_id', $this->hour)
            ->join('users', 'users.id', '=', 'staff_schedules.user_id')
            ->where('users.role', Role::MEDIC)
            ->select('staff_schedules.id as staff_schedule_id', 'staff_schedules.*', 'users.*')
            ->get();
    }

    public function mount()
    {
        $this->day = 0;
        $this->person = Person::where('ci', $this->ci)->first();
    }

    public function updatedDate()
    {
        $this->day = Carbon::parse($this->date)->dayOfWeek;
        $this->hour = null;
        if ($this->day == "null" or $this->getHours()->isEmpty()) {
        }
    }

    public function restart()
    {
        $this->reset();
    }




    public function render()
    {
        return view('livewire.add-reservation');
    }
}
