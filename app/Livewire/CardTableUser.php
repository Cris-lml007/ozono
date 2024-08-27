<?php

namespace App\Livewire;

use App\Enums\Role;
use Livewire\WithPagination;

class CardTableUser extends CardTable
{
    public function toggleStatus($id)
    {
        $query = app("App\\Models\\" . $this->model)::query();
        $obj = $query->find($id);
        if ($obj->user->active)
            $obj->user->active = false;
        else
            $obj->user->active = true;
        $obj->user->save();
    }

    public function delete($id)
    {
        $query = app("App\\Models\\" . $this->model)::query();
        $obj = $query->find($id);
        $obj->user->delete();
    }

    use WithPagination;
    public function render()
    {
        $query = app("App\\Models\\" . $this->model)::query();
        if (!empty($this->search) and $this->headSelect!='role') {
            $query->where($this->headSelect, 'LIKE', "%$this->search%")->whereHas('user', function ($query) {
                $query->where('role', Role::MEDIC)->orWhere('role', Role::NURSE)->orWhere('role', Role::ADMIN);
            });
        } else {
            $query->whereHas('user', function ($query) {
                $query->where('role', Role::MEDIC)->orWhere('role', Role::NURSE)->orWhere('role', Role::ADMIN);
            });
        }
        $collection = $query->paginate(10);
        return view('livewire.card-table', ['collection' => $collection]);
    }
}
