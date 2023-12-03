<?php

namespace App\Livewire;

use App\Models\Categories;
use App\Models\Products as ModelsProducts;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $productIdToEdit;
    public $name;
    public $price;
    public $rate;
    public $image;


    public function delete($id)
    {
        $product = ModelsProducts::findOrfail($id);
        if ($product) {
            $product->delete();
            session()->flash('success', 'Product deleted successfully!');
        }
    }

    public function edit($id)
    {
        $product = ModelsProducts::findOrfail($id);
        $this->productIdToEdit = $id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->rate = $product->rate;

        // $path = $this->image->store('images', 'public');

        // $this->rate = $path;
        $this->image = null;
    }

    public function cancleEdit()
    {
        $this->reset(["productIdToEdit", "name", 'price', 'rate', 'image']);
    }

    public function update($id)
    {
        // $this->validateOnly('editingTodoName');

        // $this->image->store('images', 'public');
        // $this->image = null;

        ModelsProducts::findOrfail($this->productIdToEdit)->update(
            [
                'name' => $this->name,
                'price' => $this->price,
                'rate' => $this->rate,
                // 'image' => $this->image,
            ]
        );

        // Clear the form

        $this->cancleEdit();
        session()->flash('success', 'product updated successfully!');
    }


    public function render()
    {
        $products = ModelsProducts::latest()->paginate(5);
        $categories = Categories::all();
        $i = 1;
        return view('livewire.products', compact('products', 'categories', 'i'));
    }
}
