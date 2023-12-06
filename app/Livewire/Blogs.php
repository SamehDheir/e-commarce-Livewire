<?php

namespace App\Livewire;

use App\Models\Blogs as ModelsBlogs;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $blogIdToEdit;
    public $showTable = true;
    public $title;
    public $description;
    public $image;
    public $auther;
    public $blogIdToShow;

    public function create()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'auther' => 'required|string|max:255',
        ]);

        $imagePath = $this->image->store('images/blogs', 'public');
        ModelsBlogs::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
            'auther' => $this->auther,
        ]);
        $this->showTable = true;
        $this->reset('title', 'description', 'image', 'auther');
        session()->flash('success', 'blogs updated successfully!');
    }


    public function showForm()
    {
        $this->showTable = false;
    }

    public function delete($id)
    {
        $blogs = ModelsBlogs::find($id);
        if ($blogs->image) {
            Storage::disk('public')->delete($blogs->image);
        }
        if ($blogs) {
            $blogs->delete();
            session()->flash('success', 'blogs deleted successfully!');
        }
    }

    public function edit($id)
    {
        $blogs = ModelsBlogs::findOrfail($id);
        $this->blogIdToEdit = $id;
        $this->title = $blogs->title;
        $this->description = $blogs->description;
        $this->auther = $blogs->auther;
    }

    public function cancleEdit()
    {
        $this->reset(["blogIdToEdit", "title", 'description', 'image', 'auther']);
    }

    public function update()
    {
        $blogs = ModelsBlogs::findOrFail($this->blogIdToEdit);

        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'auther' => 'required|string|max:255',
        ]);

        if ($this->image) {
            if ($blogs->image_path) {
                Storage::disk('public')->delete($blogs->image_path);
            }
            $blogs->image = $this->image->store('images', 'public');
        }

        $blogs->title = $this->title;
        $blogs->description = $this->description;
        $blogs->auther = $this->auther;

        $blogs->save();

        $this->cancleEdit();
        session()->flash('success', 'blogs updated successfully!');
    }

    // public function showComment($id)
    // {
    //     $blogs = ModelsBlogs::findOrfail($id);
    //     $this->blogIdToShow = $id;
    // }


    public function render()
    {
        $blogs = ModelsBlogs::latest()->paginate(5);
        $countblogs = ModelsBlogs::count();
        $i = 1;
        return view('livewire.blogs', compact('blogs', 'i', 'countblogs'));
    }
}
