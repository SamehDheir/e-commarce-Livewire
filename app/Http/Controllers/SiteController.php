<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Categories;
use App\Models\Comments;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function home()
    {
        $category_first = Categories::get()->first();
        $products = Products::all();
        $categories = Categories::get()->where('id', '!=', $category_first->id)->all();
        return view("site.home", compact("category_first", "categories", "products"));
        // $categoryCount = Products::get()->where('id', '=', $categories->id)->count();
    }

    ////////////
    public function product_details()
    {
        return view("site.product-details");
    }

    ////////////
    public function blog()
    {
        $blogs = Blogs::latest()->paginate(6);
        return view("site.blog", compact("blogs"));
    }

    ////////////
    public function shop()
    {
        return view("site.shop");
    }

    ////////////
    public function cart()
    {
        return view("site.shop-cart");
    }

    ////////////
    public function checkout()
    {
        return view("site.checkout");
    }

    ////////////
    public function contact()
    {
        return view("site.contact");
    }

    ////////////
    public function error_404()
    {
        return view("site.404");
    }

    ////////////
    public function error_500()
    {
        return view("site.500");
    }
}
