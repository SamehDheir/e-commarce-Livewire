<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        return view("site.home");
    }

    ////////////
    public function product_details()
    {
        return view("site.product-details");
    }

    ////////////
    public function blog_details()
    {
        return view("site.blog-details");
    }

    ////////////
    public function blog()
    {
        return view("site.blog");
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
