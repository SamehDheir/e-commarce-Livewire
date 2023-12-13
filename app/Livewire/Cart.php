<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cart extends Component
{
    public $cart = [];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = ModelsCart::all();
    }

    public function increaseQuantity($productId)
    {
        $product = ModelsCart::find($productId);
        $product->quantity++;
        $product->save();

        $this->loadCart();
    }
    public function decreaseQuantity($productId)
    {
        $product = ModelsCart::find($productId);
        if ($product->quantity >= 1) {
            $product->quantity--;
            $product->save();
        } else {
            $product->quantity = 1;
        }

        $this->loadCart();
    }

    public function calculateTotalPrice()
    {
        $totalPrice = 0;

        foreach ($this->cart as $product) {
            $totalPrice += $product->quantity * $product->products->price;
        }

        return $totalPrice;
    }

    public function countTotalItems()
    {
        $countProductCart = 0;

        foreach ($this->cart as $product) {
            $countProductCart += $product->quantity;
        }

        return $countProductCart;
    }

    // private function calculateCountItem()
    // {
    //     return count($this->cart);
    // }


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
            'userAuth' => Auth::user()->id,
            'totalPrice' => $this->calculateTotalPrice(),
            'countItem' => $this->countTotalItems(),
        ]);
    }
}
