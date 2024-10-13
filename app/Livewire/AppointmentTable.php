<?php

namespace App\Livewire;

use App\Models\Reservation;
use Livewire\Component;
use Livewire\WithPagination;

class AppointmentTable extends Component
{

    public $search;
    public $date;

    use WithPagination;

    public function showReservation($id){
        return redirect(route('dashboard.consultation',$id));
    }

    public function deleteReservation($id){
        Reservation::destroy($id);
    }
    public function render()
    {
        if($this->search != '' and $this->date!=''){
            $collection = Reservation::where(function($query) {
                $query->whereHas('person', function($query) {
                    $query->where('name', 'LIKE', '%' . $this->search . '%')
                          ->orWhere('surname', 'LIKE', '%' . $this->search . '%');
                })
                      ->orWhereHas('staffSchedule', function($query) {
                          $query->whereHas('staff', function($query) {
                              $query->whereHas('person', function($query) {
                                  $query->where('name', 'LIKE', '%' . $this->search . '%')
                                        ->orWhere('surname', 'LIKE', '%' . $this->search . '%');
                              });
                          });
                      });
            })->where('date', $this->date)->paginate(10);
        }else if($this->date != null or $this->date != ''){
            $collection = Reservation::where('date',$this->date)->paginate(10);
        }else if($this->search != '' or $this->search != null){
            $collection = Reservation::whereHas('person',function($query){
                $query->Where('name','LIKE','%'.$this->search.'%')
                      ->orWhere('surname','LIKE','%'.$this->search.'%');
            })->orWhereHas('staffSchedule',function($query){
                $query->whereHas('staff',function($query){
                    $query->whereHas('person',function($query){
                        $query->Where('name','LIKE','%'.$this->search.'%')
                              ->orWhere('surname','LIKE','%'.$this->search.'%');
                    });
                });
            })->paginate(10);
        }else{
            $collection = Reservation::paginate(10);
        }
        return view('livewire.appointment-table',['collection' => $collection]);
    }
}
