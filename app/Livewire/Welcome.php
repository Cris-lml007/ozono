<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Welcome extends Component
{

    public $name;
    public $message;
    public $phone;

    public function getWhatsapp(){
        return redirect("https://wa.me/591$this->phone");
    }

    public function sendMessage(){
        return redirect("https://wa.me/591$this->phone?text=".urlencode('Hola, me llamo '.$this->name.', '.$this->message));
    }

    public function mount(){
        $this->phone = Setting::first()->phone;
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.welcome');
    }
}
