<?php

namespace App\Livewire;

use App\Models\Person;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Patient extends Component
{

    public $search;

    public function gethistory($id){
        return $this->redirect(route('dashboard.historyPatient',$id));
    }

    use WithPagination;
    public function render()
    {
        if($this->search != '' or $this->search != null)
            $collection = Person::orWhere('ci','LIKE','%'.$this->search.'%')
                ->orWhere('surname','LIKE','%'.$this->search.'%')
                ->orWhere('name','LIKE','%'.$this->search.'%')
                ->orWhere('name','LIKE','%'.$this->search.'%')
                ->orWhere('birthdate','LIKE','%'. Carbon::now()->year- ((int)$this->search ?? 0) .'%')
                ->paginate(10);
        else
            $collection = Person::paginate(10);
        return view('livewire.patient',['collection' => $collection]);
    }
}
