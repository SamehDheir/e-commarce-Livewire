<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $search;

    public function delete($id)
    {
        $User = User::findOrfail($id);
        if ($User) {
            $User->delete();
            session()->flash('success', 'User deleted successfully!');
        }
    }

    public function render()
    {
        return view('livewire.users', [
            'users' => User::latest()->where('name', 'like', "%{$this->search}%")->paginate(5),
            'i' =>  1
        ]);
    }
}
