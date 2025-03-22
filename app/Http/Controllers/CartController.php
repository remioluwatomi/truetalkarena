<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartList()
    {
        $info = new PageController();
        $info = $info->getInfos();
        $socials = Social::where('soc_status', '=', 'active')->get();
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('cart', compact('cartItems', 'info', 'socials'));
    }
    public function getCart()
    {
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return $cartItems;
    }


    public function addToCart(Request $request)
    {
        $cartItems = \Cart::getContent()->toArray();
        $key = array_search($request->id, array_column($cartItems, 'id'));

        if ($key === false) {
            \Cart::add([
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => 1,
                'attributes' => array(
                    'image' => $request->image,
                    'slug' => $request->slug,
                )
            ]);
            $message = 'Product is Added to Cart Successfully !';
        } else {
            $message = 'Product is already in Cart !';
        }
        session()->flash('success', $message);

        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        $cartItems = \Cart::getContent()->toArray();
        $key = array_search($request->id, array_column($cartItems, 'id'));
        // dd($key);
        if ($key === false) {

            \Cart::update(
                $request->id,
                [
                    'quantity' => [
                        'relative' => false,
                        'value' => 1
                    ],
                ]
            );
        }

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
}
