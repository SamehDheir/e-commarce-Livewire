<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $productId = $request->input('product_id');
        $userId = $request->input('user_id');

        if ($userId && $productId) {
            Cart::create([
                'product_id' => $productId,
                'user_id' => $userId,
                'quantity' => $request->input('quantity'),
                'size' => $request->input('size'),
                'availability' => $request->input('availability'),
                'color' => $request->input('color'),
            ]);
        } else {
            return redirect()->route('login');
        }

        Alert::success('Success Title', 'Success Message');
        return redirect()->back();
    }

    /**٫
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
