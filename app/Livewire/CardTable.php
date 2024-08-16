<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class CardTable extends Component
{
    public $title;
    public $heads;
    public $model;
    public $search;
    public $headSelect;
    public $idSelect;
    public $keyEmit;
    public $modal;

    public $onDelete=false;

    protected $listeners = ['update'];

    public function mount($model=null,$heads=null,$headSelect=null,$emit=null,$modal=null){
        $this->model = $model;
        $this->heads = $heads;
        $this->headSelect = $headSelect;
        $this->keyEmit = $emit;
        $this->modal = $modal;
    }

    public function toggleStatus($id){
        $query = app("App\\Models\\" . $this->model)::query();
        $obj = $query->find($id);
        if($obj->active)
            $obj->active = false;
        else
            $obj->active = true;
        $obj->save();
    }

    public function edit($id){
        $this->dispatch($this->keyEmit,$id);
    }

    public function delete($id){
        $query = app("App\\Models\\" . $this->model)::query();
        $obj = $query->find($id);
        // dd($obj);
        $obj->delete();
    }

    use WithPagination;
    public function render()
    {
        $query = app("App\\Models\\" . $this->model)::query();
        if(!empty($this->search)){
            $query->where($this->headSelect,'LIKE',"%$this->search%");
        }
        $collection = $query->paginate(10);
        return view('livewire.card-table',['collection'=>$collection]);
    }
}
