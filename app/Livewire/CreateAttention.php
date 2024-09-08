<?php

namespace App\Livewire;

use App\Enums\Role;
use App\Models\Person;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Staff_schedule;
use App\Models\Treatment;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateAttention extends Component
{

    public $date;
    #[Validate('integer|min:1|max:6')]
    public $day;
    public $hour;
    public $medic;

    public $ci;
    public $surname;
    public $name;
    public $birthdate;
    public $gender;


    public $person;

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

    public function getPerson()
    {
        $this->person = Person::where('ci', $this->ci)->first();
        if ($this->person) {
            $this->ci = $this->person->ci;
            $this->surname = $this->person->surname;
            $this->name = $this->person->name;
            $this->birthdate = $this->person->birthdate;
            $this->gender = $this->person->gender;
        } else {
            $this->person = null;
            $this->reset(['surname', 'name', 'birthdate', 'gender']);
        }
    }

    public function createAttention()
    {
        $this->validate();
        if (!$this->person) {
            $this->person = Person::create([
                'ci' => $this->ci,
                'surname' => $this->surname,
                'name' => $this->name,
                'birthdate' => $this->birthdate,
                'gender' => $this->gender
            ]);
        }
        Reservation::create([
            'person_id' => $this->person->id,
            'staff_schedule_id' => $this->medic,
            'date' => $this->date
        ]);
    }

    public function getMedics()
    {
        return Staff_schedule::where('schedule_id', $this->hour)
            ->join('users', 'users.id', '=', 'staff_schedules.user_id')
            ->where('users.role', Role::MEDIC)
            ->select('staff_schedules.id as staff_schedule_id', 'staff_schedules.*', 'users.*')
            ->get();
    }

    public function getPrice()
    {
        return Treatment::find($this->treatment)?->price;
    }

    public function mount()
    {
        $this->day = 0;
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
        return view('livewire.create-attention');
    }
}
