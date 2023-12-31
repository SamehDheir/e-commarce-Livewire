<?php

namespace App\Livewire;

use App\Models\Categories as ModelsCategories;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $categoryIdToEdit;
    public $showTable = true;
    public $name;
    public $description;
    public $image;

    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $this->image->store('images/categories', 'public');
        ModelsCategories::create([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imagePath,
        ]);
        $this->showTable = true;
        $this->reset('name', 'description', 'image');
        // session()->flash('success', 'category updated successfully!');
        toastr()->success('Category Created successfully', ['timeOut' => 2000]);
    }


    public function showForm()
    {
        $this->showTable = false;
    }

    public function delete($id)
    {
        $category = ModelsCategories::find($id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        if ($category) {
            $category->delete();
            // session()->flash('success', 'Category deleted successfully!');
            toastr()->success('Category deleted successfully', ['timeOut' => 2000]);
        }
    }

    public function edit($id)
    {
        $category = ModelsCategories::findOrfail($id);
        $this->categoryIdToEdit = $id;
        $this->name = $category->name;
        $this->description = $category->description;
    }

    public function cancleEdit()
    {
        $this->reset(["categoryIdToEdit", "name", 'description', 'image']);
    }

    public function update()
    {
        $category = ModelsCategories::findOrFail($this->categoryIdToEdit);

        $this->validate([
            'name' => 'required|string|max:255',
            // 'description' => 'required|string|max:255',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($this->image) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $category->image = $this->image->store('images', 'public');
        }

        $category->name = $this->name;
        $category->description = $this->description;

        $category->save();

        $this->cancleEdit();
        // session()->flash('success', 'category updated successfully!');
        toastr()->success('Category updated successfully', ['timeOut' => 2000]);
    }


    public function render()
    {
        $categories = ModelsCategories::latest()->paginate(5);
        $countCategory = ModelsCategories::count();
        $i = 1;
        return view('livewire.categories', compact('categories', 'i', 'countCategory'));
    }
}
