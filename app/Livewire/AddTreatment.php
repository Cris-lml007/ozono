<?php

namespace App\Livewire;

use App\Models\Person;
use App\Models\Setting;
use App\Models\Treatment;
use Livewire\Component;

class AddTreatment extends Component
{

    public $search_treatment;
    public $price;
    public $pricePlaceholder;
    public $quantity;
    public $by_day;
    public $treatment;
    public $total;

    public $ci;

    public function getTreatment(){
        return empty($this->search_treatment) ? Treatment::all() : Treatment::where('name','LIKE',"%".$this->search_treatment."%")->get();
    }

    public function updatedQuantity(){
        if(!empty($this->quantity and $this->pricePlaceholder)){
            if(!empty($this->price))
                $this->total = $this->quantity * $this->price;
            else
                $this->total = $this->quantity * $this->pricePlaceholder;
        }else{
            $this->total = 0;
        }
    }

    public function updatedPrice(){
        if(!empty($this->quantity and $this->pricePlaceholder)){
            if(!empty($this->price))
                $this->total = $this->quantity * $this->price;
            else
                $this->total = $this->quantity * $this->pricePlaceholder;
        }else{
            $this->total = 0;
        }
    }

    public function updatedTreatment(){
        $treatment = Treatment::find($this->treatment);
        if($treatment == null) return;
        $this->pricePlaceholder = $treatment->price;
        if(!empty($this->quantity and $this->pricePlaceholder)){
            if(!empty($this->price))
                $this->total = $this->quantity * $this->price;
            else
                $this->total = $this->quantity * $this->pricePlaceholder;
        }else{
            $this->total = 0;
        }
    }

    public function addTreatment(){
        if(empty($this->price)) $this->price = $this->pricePlaceholder;
        if(empty($this->by_day)) $this->by_day = 1;
        $this->dispatch("addTreatment",$this->treatment, $this->price, $this->quantity,$this->by_day);
        $this->restart();
    }

    public function restart(){
        $this->reset();
    }

    public function render()
    {
        return view('livewire.add-treatment');
    }
}
