<?php

namespace App\Livewire;

use App\Models\Detail_diagnostic;
use App\Models\Diagnostic;
use App\Models\History;
use App\Models\Person;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Setting;
use App\Models\Treatment;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Consultation extends Component
{
    public $person_id;
    public $ci;
    public $surname;
    public $name;
    public $age;
    public $gender;
    public $allergies;
    public $surgeries;
    public $pathological;



    public $presure;
    public $temperature;
    public $respiratory_rate;
    public $heart_rate;
    public $evaluation;

    public $weight;
    public $height;
    public $imc;
    public $imcStatus;


    public $subjetive_intensity;
    public $rate;
    public $consumption_painkillers;
    public $incapacitation;
    public $body_pain = [];
    public $detail_diagnostic;

    public $search_treatment;
    public $reservation;

    public $diagnostic;
    public $treatments = [];
    public $treatments_save = [];

    public $is_open = false;

    public $date;
    public $schedule;
    public $schedules = [];
    public $reservations = [];

    public $treatment_save;
    public $treatment_new;
    public $total = 0;
    public $total_origin = 0;
    public $canceled;
    public $canceled_placeholder = 0;

    public Setting $setting;

    protected $listeners = ["addTreatment"];

    public function rules(){
        return [
            'schedule' => [
                Rule::unique('reservations','staff_schedule_id')->where(fn(Builder $query) => $query->where('date',$this->date))
            ]
        ];
    }

    public function addTreatment($id, $price, $quantity, $by_day)
    {
        $treatment = Treatment::find($id);
        $obj = [
            'id' => $treatment->id,
            'name' => $treatment->name,
            'price' => $price,
            'quantity' => $quantity,
            'by_day' => $by_day
        ];
        $this->total += $price * $quantity;
        $this->total_origin = $this->total;
        $this->treatments [] = $obj;
    }

    public function saveVitalSigns()
    {
        $this->validate([
            'presure' => 'required',
            'heart_rate' => 'required',
            'temperature' => 'required',
            'respiratory_rate' => 'required'
        ]);
        History::create([
            'nurse_id' => Auth::user()->person->id ?? null,
            'person_id' => $this->reservation->person->id,
            'reservation_id' => $this->reservation->id,
            'presure' => $this->presure,
            'temperature' => $this->temperature,
            'heart_rate' => $this->heart_rate,
            'respiratory_rate' => $this->respiratory_rate,
            'weight' => $this->weight,
            'height' => $this->height,
            'canceled' => 0
        ]);
        $this->reservation = Reservation::find($this->reservation->id);
        if(!$this->is_open) $this->redirect(route('dashboard.main'));
    }

    public function getDiagnostic($id)
    {
        $this->diagnostic = Diagnostic::find($id);
        $this->detail_diagnostic = $this->diagnostic->description;
        $this->diagnostic->detail_diagnostic;

        $this->detail_diagnostic = $this->diagnostic->description;
        $this->body_pain = explode(',',$this->diagnostic->body_pain);
        $this->rate = $this->diagnostic->rate;
        $this->consumption_painkillers = $this->diagnostic->consumption_painkillers;
        $this->incapacitation = $this->diagnostic->incapacitation;
        $this->subjetive_intensity = $this->diagnostic->subjetive_intensity;
        $this->total = $this->diagnostic->detail_diagnostics()->selectRaw('SUM(price * quantity) as total')->value('total');
        $this->reservations = Reservation::where('person_id',$this->reservation->person_id)->where('date','>=',Carbon::now())->whereHas('staffSchedule',function ($query){
            $query->where('user_id',Auth::user()->id);
        })->whereHas('history',function($query){
            $query->where('reservation_id',null);
        })->get();
        foreach(History::where('person_id',$this->reservation->person_id)->get() as $history){
            // dd($history);
            if($history->detailDiagnostic->diagnostic_id == $this->diagnostic->id){
                $this->total -= $history->canceled;
            }
        }
        $this->total_origin = $this->total;
        $this->openDiagnostic();
    }

    public function toogleFinish(){
        $this->diagnostic->status = $this->diagnostic->status ? false : true;
        $this->diagnostic->save();
        if($this->diagnostic->status == false) $this->closeDiagnostic();
    }

    public function countTreatment($detail_id){
        return $this->reservation->person->history()->where('detail_diagnostic_id',$detail_id)->count();
    }

    public function getDiagnostics()
    {
        return Person::where('ci', $this->ci)->first()->diagnostics();
    }

    public function updateOrCreateDiagnostic()
    {
        $this->validate([
            'subjetive_intensity' => 'required',
            'rate' => 'required',
            'incapacitation' => 'required',
            'consumption_painkillers' => 'required',
            'detail_diagnostic' => 'required',
            'evaluation' => 'required',
        ]);
        if ($this->reservation->history == null) {
            $this->saveVitalSigns();
        }
        if($this->treatment_new == null  and $this->treatment_save == null){
            return $this->addError('val','No se selecciono un tratamiento');
        }
        if(empty($this->canceled) or $this->canceled == ''){
            $this->canceled = $this->canceled_placeholder;
        }
        $this->reservation->history->description = $this->evaluation;
        $this->reservation->history->canceled = $this->canceled;
        $this->reservation->history->medic_id = Auth::user()->person->id;
        $this->reservation->history->save();

        if($this->diagnostic == null){
            $this->diagnostic = new Diagnostic();
            $this->diagnostic->history_id = $this->reservation->history->id;
        }
        $this->diagnostic->description = $this->detail_diagnostic;
        $this->diagnostic->body_pain = implode(',',$this->body_pain);
        $this->diagnostic->rate = $this->rate;
        $this->diagnostic->consumption_painkillers = $this->consumption_painkillers;
        $this->diagnostic->incapacitation = $this->incapacitation;
        $this->diagnostic->subjetive_intensity = $this->subjetive_intensity;
        $this->diagnostic->save();
        $list = [];
        $treat = null;
        foreach ($this->treatments as $key => $item) {
            if($this->treatment_new != null  and $key==$this->treatment_new){
                $treat = [
                    'diagnostic_id' => $this->diagnostic->id,
                    'treatment_id' => $item['id'],
                    'quantity' => $item["quantity"],
                    'price' => $item["price"],
                    'by_day' => $item["by_day"]
                ];
            }else
                $list [] = [
                    'diagnostic_id' => $this->diagnostic->id,
                    'treatment_id' => $item['id'],
                    'quantity' => $item["quantity"],
                    'price' => $item["price"],
                    'by_day' => $item["by_day"]
                ];
        }
        Detail_diagnostic::upsert(
            $list,
            [],
            []
        );
        if($treat != null){
            $d = Detail_diagnostic::create($treat);
            $this->reservation->history->detail_diagnostic_id = $d->id;
        }else{
            $this->reservation->history->detail_diagnostic_id = $this->treatment_save;
        }
        $this->reservation->history->save();
        Reservation::upsert(
            $this->schedules,
            [],
            []
        );
        $this->redirect(route('dashboard.main'));
    }

    public function updatedTreatmentSave(){
        if($this->treatment_save == null) return;
        $this->total = $this->total_origin;
        $this->canceled_placeholder = $this->diagnostic->detail_diagnostics()->find($this->treatment_save)->price;
        $this->total -= $this->canceled_placeholder;
        $this->treatment_new = null;
    }

    public function updatedTreatmentNew(){
        if($this->treatment_new == null) return;
        $this->treatment_save = null;
        $this->total = $this->total_origin;
        $this->canceled_placeholder = $this->treatments[$this->treatment_new]['price'];
        $this->total -= $this->canceled_placeholder;
        // $this->treatment_new = null;
    }

    public function updatedCanceled(){
        if(isset($this->canceled) and $this->canceled != ''){
            $this->total = $this->total_origin;
            $this->total -= $this->canceled;
        }else{
            $this->total = $this->total_origin;
        }
    }

    public function getSchedules()
    {
        return Schedule::where('day',Carbon::parse($this->date)->dayOfWeek)->first()?->staffSchedule()->where('user_id',Auth::user()->id)->get();
        // return Staff_schedule::where('medic_id', Auth::user()->id)->where('');
    }

    public function updatedDate(){
        $this->schedule = null;
        $this->validate();
    }

    public function ss(){
        dd($this->treatment_new,$this->treatment_save);
    }

    public function updatedSchedule(){
        $this->validate();
        // return dd(Schedule::where('day',Carbon::parse($this->date)->dayOfWeek)->first()?->staffSchedule()?->where('user_id',Auth::user()->id)->get());
    }

    public function addReservation()
    {
        $this->validate();
        foreach ($this->schedules as $schedule) {
            if ($schedule['staff_schedule_id'] == $this->schedule && $schedule['date'] == $this->date) {
                // Si se encuentra un duplicado, puedes lanzar un mensaje de error o realizar otra acción
                $this->addError('schedule', 'La reserva ya ha sido añadida anteriormente.');
                return;
            }
        }
        $r =[
            'person_id' => $this->reservation->person_id,
            'staff_schedule_id' => $this->schedule,
            'date' => $this->date
        ];
        $this->schedules [] = $r;
    }

    public function deleteReservation($pos){
        unset($this->schedules[$pos]);
    }

    public function deleteSaveReservation($id){
        Reservation::destroy($id);
    }

    public function deleteTreatment($pos){
        $this->total = $this->total_origin;
        $this->total -= $this->treatments[$pos]['price'] * $this->treatments[$pos]['quantity'];
        $this->total_origin = $this->total;
        unset($this->treatments[$pos]);
    }

    public function mount(Reservation $reservation)
    {
        if(Gate::allows('administration',Auth::user())){
            return redirect()->route('dashboard.main');
        }
        $this->setting = Setting::first();
        $this->person_id = $reservation->person->id;
        $this->ci = $reservation->person->ci;
        $this->surname = $reservation->person->surname;
        $this->name = $reservation->person->name;
        $this->gender = $reservation->person->gender == 1 ? "Hombre" : "Mujer";
        $this->age = Carbon::now()->year - Carbon::parse($reservation->person->birthdate)->year;

        $this->allergies = $this->reservation->person->allergies;
        $this->surgeries = $this->reservation->person->surgeries;
        $this->pathological = $this->reservation->person->pathological;

        if ($this->reservation->history != null) {
            $this->presure = $reservation->history->presure;
            $this->temperature = $reservation->history->temperature;
            $this->heart_rate = $reservation->history->heart_rate;
            $this->respiratory_rate = $reservation->history->respiratory_rate;
            $this->weight = $reservation->history->weight;
            $this->height = $reservation->history->height;
            $this->getIMC();
            $this->evaluation = $reservation->history->description;
        }
    }

    public function openDiagnostic()
    {
        $this->is_open = true;
    }

    public function closeDiagnostic()
    {
        $this->reset(
            'schedules',
            'treatments',
            'evaluation',
            'rate',
            'incapacitation',
            'body_pain',
            'subjetive_intensity',
            'consumption_painkillers',
            'date',
            'schedule',
            'diagnostic',
            'total',
            'canceled'
        );
        // $this->validate();
        $this->clearValidation();
        $this->is_open = false;
    }

    public function updatedWeight()
    {
        $this->getIMC();
    }

    public function updatedHeight()
    {
        $this->getIMC();
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

    public function restart()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.consultation');
    }
}
