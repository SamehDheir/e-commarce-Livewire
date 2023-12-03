<?php

namespace App\Livewire;

use App\Models\Categories as ModelsCategories;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $categoryIdToEdit;
    public $name;
    public $description;


    public function delete($id)
    {
        $category = ModelsCategories::find($id);
        if ($category) {
            $category->delete();
            session()->flash('success', 'Category deleted successfully!');
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
        $this->reset(["categoryIdToEdit", "name", 'description']);
    }

    public function update($id)
    {
        // $this->validateOnly('editingTodoName');
        ModelsCategories::findOrfail($this->categoryIdToEdit)->update(
            [
                'name' => $this->name,
                'description' => $this->description,
            ]
        );

        // Clear the form

        $this->cancleEdit();
        session()->flash('success', 'category updated successfully!');
    }


    public function render()
    {
        $categories = ModelsCategories::latest()->paginate(5);
        $i = 1;
        return view('livewire.categories', compact('categories', 'i'));
    }
}
