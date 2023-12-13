<?php

namespace App\Livewire;

use App\Models\Blogs as ModelsBlogs;
use App\Models\Comments;
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
    public $showComment = false;
    public $title;
    public $description;
    public $image;
    public $auther;
    public $blogIdToShow;


    public function create()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
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
        $blogs = ModelsBlogs::findOrfail($this->blogIdToEdit);

        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

    public function show_comment($id)
    {
        $this->blogIdToShow = $id;
        ModelsBlogs::findOrfail($this->blogIdToShow);
        $this->showComment = true;
        $this->dispatch('show_blog', array('blog_id' => $this->blogIdToShow));
    }

    public function cancle_comment()
    {
        $this->showComment = false;
    }

    public function deleteComment($id)
    {
        Comments::findOrfail($id)->delete();
    }


    public function render()
    {
        $blogs = ModelsBlogs::latest()->paginate(6);
        $blog_comment = Comments::latest()->where('blog_id', '=', $this->blogIdToShow)->paginate(6);
        $count_blog_comment = Comments::where('blog_id', '=', $this->blogIdToShow)->count();
        $countblogs = ModelsBlogs::count();
        $i = 1;
        return view('livewire.blogs', compact('blogs', 'blog_comment', 'count_blog_comment', 'i', 'countblogs'));
    }
}
