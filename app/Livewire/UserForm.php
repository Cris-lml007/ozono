<?php

namespace App\Livewire;

use App\Enums\Day;
use App\Models\Person;
use App\Models\Schedule;
use App\Models\Staff_schedule;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Nette\Utils\Random;

class UserForm extends Component
{
    public $id;
    public $ci;
    #[validate('required|string')]
    public $surname;
    #[validate('required|string')]
    public $name;
    #[validate('required|date')]
    public $birthdate;
    public $gender;
    public $email;
    public $role;
    public $password;

    public $exp;

    public $daySelect;
    public $schedule_day;

    public Person $person;

    protected $listeners = [
        'staffEdit' => 'getStaff',
        'showDeleteConfirmation'
    ];


    protected function rules()
    {
        return [
            'ci' => 'required|integer|unique:persons,ci,' . $this->id,
            'email' => 'required|unique:users,email,'.($this->person && $this->person->user ? $this->person->user->id : null)
        ];
    }

    public function mount(){
        $this->person = new Person();
    }

    public function updateOrCreate()
    {
        $this->validate();
        $this->person = Person::updateOrCreate(
            ['ci' => $this->ci],
            [
                'surname' => $this->surname,
                'name' => $this->name,
                'birthdate' => $this->birthdate,
                'gender' => $this->gender,
                'exp' => $this->exp
            ]
        );
        $password = strtolower(substr(str_word_count($this->surname,1)[0],0,strlen(str_word_count($this->surname,1)[0])/2).substr(str_word_count($this->name,1)[0],0,strlen(str_word_count($this->name,1)[0])/2)).$this->ci;
        $this->password = $password;
        User::updateOrCreate(
            ['email' => $this->email],
            [
                'role' => $this->role,
                'person_id' => $this->person->id,
                'password' => $this->person->user ? $this->person->user->password : $password
            ]
        );
        $this->getStaff($this->person->id);
    }

    public function getStaff($id)
    {
        $this->person = Person::find($id);
        $this->id = $this->person->id;
        $this->ci = $this->person->ci;
        $this->exp = $this->person->exp;
        $this->surname = $this->person->surname;
        $this->name = $this->person->name;
        $this->gender = $this->person->gender;
        $this->email = $this->person->user->email;
        $this->role = $this->person->user->role;
        $this->birthdate = $this->person->birthdate;
        $this->password =strtolower(substr(str_word_count($this->surname,1)[0],0,strlen(str_word_count($this->surname,1)[0])/2).substr(str_word_count($this->name,1)[0],0,strlen(str_word_count($this->name,1)[0])/2)).$this->ci;
        $this->validate();
    }

    public function confirmDelete()
    {
        $this->dispatch('showDeleteConfirmation');
    }

    public function deleteStaff()
    {
        $this->person->user()->delete();
        $this->restart();
    }

    public function restart()
    {
        $this->reset();
    }

    public function getDays($day){
        return Schedule::where('day',$day)->orderBy('start')->get();
    }

    public function getScheduleByDay($day){
        return $this->person->user->schedules()->where('schedules.day',$day)->get();
    }

    public function addSchedule(){
        Staff_schedule::create([
            'user_id' => $this->person->user->id,
            'schedule_id' => $this->schedule_day
        ]);
    }

    public function deleteSchedule($id){
        $this->person->user->schedules()->detach($id);
    }


    public function render()
    {
        $this->dispatch('update');
        return view('livewire.user-form');
    }
}
