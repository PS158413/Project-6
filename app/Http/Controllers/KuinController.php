<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class KuinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $response = Http::get('http://nickvanhooff.com/api_groene_vingers/public/api/kuin');
        if ($response->ok()) {
            $data = $response->json(); // get the "data" field from the response
            $products = $data; // get the array of products from the "data" field
            if ($request->has('q')) {
                $q = $request->query('q');
                $products = array_filter($products, function ($product) use ($q) {
                    return stripos($product['description'], $q) !== false
                        || stripos($product['name'], $q) !== false
                        || $product['id'] == $q;
                });
            }
            // add pagination
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($products);
            $perPage = 50;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $paginatedItems->setPath(request()->url());
            $products = $paginatedItems;
            //end pagination
            return view('admin.index', ['products' => $products]);
        } else {
            abort(500, 'Failed to fetch products from API');
        }

//        // pagination
//        $currentPage = LengthAwarePaginator::resolveCurrentPage();
//        $itemCollection = collect($products);
//        $perPage = 10;
//        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
//        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
//        $paginatedItems->setPath(request()->url());
//        $products = $paginatedItems;
//        //end pagination
//
//        return view('admin.index', ['products' => $products]);
    }

    //make a function to show the products from the api
    public function showProduct($productId)
    {
        $token = env('Kuin_token');
        $response = Http::withToken($token)->get('http://kuin.summaict.nl/api/product/'.$productId);
        $product = $response->json();

        return view('admin.showProduct', ['product' => $product]);
    }

    public function delete()
    {
    }

    public function store(Request $request)
    {
        //get all checked products
        $token = env('Kuin_token');
        // Get the data from the form submission
        $request->validate([
            'selected.*' => 'array',
            'selected.*' => 'integer',
            'quantity.*' => 'array',
            'quantity.*' => 'integer',
        ]);
        // Loop through the checked products and quantities and make a post request for each
        $response = Http::post('http://nickvanhooff.com/api_groene_vingers/public/api/kuin/store', [
            '_token' => $request->input('_token'),
            'selected' => $request['selected'],
            'quantity' => $request['quantity'],

        ]);
        if ($response->ok()) {
            $data = $response->json(); // get the "data" field from the response
            $order = $data; // get the array of products from the "data" field
           //if the response is succes then redirect to the order page
            if ($response->successful()) {
                return redirect()->route('admin.index')->with('success', 'Order is geplaatst');
            } else {
                return redirect()->route('admin.index')->with('error', 'Order is niet geplaatst');
            }
        } else {
            // dd("fail");
            throw new Exception($response->json()['message']);
        }
    }

    public function show($order)
    {
        $token = env('Kuin_token');
        $response = Http::withToken($token)->get('http://kuin.summaict.nl/api/orderItem?order_id='.$order);
        $orderItems = $response->json();
        $products = [];

        foreach ($orderItems as $orderItem) {
            $productId = $orderItem['product_id'];
            $response = Http::withToken($token)->get('http://kuin.summaict.nl/api/product/'.$productId);
            $product = $response->json();
            $products[] = $product;
        }

        return view('admin.show', [
            'orderItems' => $orderItems,
            'products' => $products,
        ]);
    }

    public function getOrder()
    {
        $response = Http::get('http://nickvanhooff.com/api_groene_vingers/public/api/kuin/orders');
        if ($response->ok()) {
            $data = $response->json(); // get the "data" field from the response
            $kuinorder = $data; // get the array of products from the "data" field

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($kuinorder);
            $perPage = 10;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $paginatedItems->setPath(request()->url());
            $kuinorder = $paginatedItems;

            return view('admin.order', ['orders' => $kuinorder]);
        } else {
            abort(500, 'Failed to fetch products from API');
        }
    }
}
