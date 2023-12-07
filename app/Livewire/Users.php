<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $search;
    public $cartIdToShow;
    public $showTable = true;
    public $showCartProduct = false;
    public $quantity = 1;

    public function delete($id)
    {
        $User = User::findOrfail($id);
        if ($User) {
            $User->delete();
            session()->flash('success', 'User deleted successfully!');
        }
    }

    public function showCart($id)
    {
        $this->cartIdToShow = $id;
        $this->showCartProduct = true;
    }

    public function cancle_cart()
    {
        $this->showCartProduct = false;
    }

    public function render()
    {
        return view('livewire.users', [
            'users' => User::latest()->where('name', 'like', "%{$this->search}%")->paginate(5),
            'userCart' => Cart::where('user_id', '=', $this->cartIdToShow)->get(),
            'i' =>  1
        ]);
    }
}
