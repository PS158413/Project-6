<?php

namespace App\Http\Controllers;

use App\Models\Cart;
//use cart model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function cartList(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
//        $cartItems = \Cart::getContent();
//        // dd($cartItems);
//        return view('cart', compact('cartItems'));
        return view('cart');
    }

    public function addToCart(Request $request)
    {
        $product = $request->id;
        $quantity = $request->quantity;
        $token = env('Api_token');
        $response = Http::withToken($token)->get('http://nickvanhooff.com/api_gv/public/api/product/'.$product);
        $product = $response->json()['data'];

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity']++;
        } else {
            $cart[$request->id] = [
                'name' => $product['name'],
                'image' => $product['image'],
                'price' => $product['price'],
                'quantity' => $quantity,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');

            return redirect()->back()->with('success', 'Product remove from cart successfully!');
        }
    }

//    public function clearAllCart()
//    {
//        \Cart::clear();
//
//        session()->flash('success', 'All Item Cart Clear Successfully !');
//
//        return redirect()->route('cart.list');
//    }
}
