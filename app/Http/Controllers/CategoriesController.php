<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index()
    {
        return view('admin.tabels.categories');
    }

    public function show($id)
    {
        $products = Products::where('category_id', $id)->get();
        return view('site.shop', compact('products'));
    }
}
