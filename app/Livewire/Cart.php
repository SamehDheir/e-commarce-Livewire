<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Cart extends Component
{
    public function delete($id)
    {
        $productCart = ModelsCart::findOrfail($id);

        if ($productCart) {
            $productCart->delete();
            session()->flash('success', 'Product Cart deleted successfully!');
        }
    }
    public function render()
    {
        return view('livewire.cart', [
            'cart' => ModelsCart::all(),
            'userAuth' => Auth::user()->id,
        ]);
    }
}
