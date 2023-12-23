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
            $cart = Cart::create([
                'product_id' => $productId,
                'user_id' => $userId,
            ]);
            if ($request->input('size') || $request->input('availability') || $request->input('color') || $request->input('quantity')) {
                $cart->size = $request->input('size');
                $cart->availability = $request->input('availability');
                $cart->color = $request->input('color');
                $cart->quantity = $request->input('quantity');
            }
            $cart->save();
        } else {
            return redirect()->route('login');
        }

        // Alert::success('Success Title', 'Success Message');
        toastr()->success('Added to cart successfully', ['timeOut' => 3000]);
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
