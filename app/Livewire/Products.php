<?php

namespace App\Livewire;

use App\Models\Categories;
use App\Models\Products as ModelsProducts;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $productIdToEdit;
    public $search;
    public $name;
    public $price;
    public $rate;
    public $category_id;

    #[Rule(['image.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'])]
    public $image;

    public $showTable = true;



    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'rate' => 'required|numeric|min:1|max:5',
            'category_id' => 'required|exists:categories,id',
            // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        foreach ($this->image as $item) {
            $imagePath = $item->store('images/products', 'public');
        };


        ModelsProducts::create([
            'name' => $this->name,
            'price' => $this->price,
            'rate' => $this->rate,
            'category_id' => $this->category_id,
            'image' => $imagePath,
        ]);
        $this->showTable = true;
        $this->reset('name','price','rate','category_id','image');

        session()->flash('success', 'product updated successfully!');
    }

    public function showForm()
    {
        $this->showTable = false;
    }

    public function delete($id)
    {
        $product = ModelsProducts::findOrfail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
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
    }

    public function cancleEdit()
    {
        $this->reset(["productIdToEdit", "name", 'price', 'rate', 'image']);
    }

    public function update($id)
    {
        $product = ModelsProducts::findOrFail($this->productIdToEdit);

        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'rate' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust this based on your needs
        ]);

        // Delete the old image if a new one is selected
        if ($this->image) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $this->image->store('images/products', 'public');
        }

        // Update other product information
        $product->name = $this->name;
        $product->price = $this->price;
        $product->rate = $this->rate;
        $product->category_id = $this->category_id;

        $product->save();


        $this->cancleEdit();
        session()->flash('success', 'product updated successfully!');
    }


    public function render()
    {
        $products = ModelsProducts::latest()->where('name', 'like', "%{$this->search}%")->paginate(5);
        $countProduct = ModelsProducts::count();
        $categories = Categories::all();
        $i = 1;
        return view('livewire.products', compact('products', 'categories', 'i', 'countProduct'));
    }
}
