<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Comments;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tabels.blogs');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blogs::find($id);

        if (!$blog) {
            abort(404, 'Post not found');
        }

        $blogs_comment = Comments::latest()->where('blog_id', '=', $blog->id)->paginate(5);
        $count_blog_comment = $blogs_comment->count();

        return view('site.blog-details', compact('blog', 'blogs_comment', 'count_blog_comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blogs $blogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blogs $blogs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blogs $blogs)
    {
        //
    }
}
