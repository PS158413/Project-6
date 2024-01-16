<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{

    public function index(Request $request)
    {

        $page = $request->input('page', 1);



        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/product/all?page=' . $page);

        if ($response->failed()) {
            abort(500, 'Failed to retrieve products from API');
        }

        $data = $response->json();

        // dd($data);

        $lastpage = $data['data']['last_page'];
        $currentpage = $data['data']['current_page'];

        $products = $data['data']['data'];
        $nextPageUrl = $data['data']['next_page_url'];


        // Check if the current page is greater than the requested page
        if ($currentpage > $lastpage) {
            return redirect()->route('product.index', ['page' => $lastpage]);
        }

        // Check if the current page is greater than the requested page
        if ($currentpage > $page) {
            return redirect()->route('product.index', ['page' => $currentpage]);
        }


        return view('shop.products', compact('products', 'page', 'nextPageUrl', 'currentpage', 'lastpage'));
    }
    
    public function test()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/product');

        if ($response->failed()) {
            abort(500, 'Failed to retrieve products from API');
        }

        $data = $response->json()['data']['data'];

        dd($data);
    }

    public function delete()
    {
    }

    public function create()
    {

        return view('create');
    }

    public function show($product)
    {


        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/product/' . $product);

        if ($response->failed()) {
            abort(500, 'Failed to retrieve users from API');
        }

        $data = $response->json()['data']['data'];

        dd($product);

        return view('shop.show_product', compact('product'));





        // $token = env('Api_token');
        // $response = Http::withToken($token)->get('https://nickvanhooff.com/api_gv/public/api/product/' . $product);
        // $product = $response->json()['data'];

        // return view('shop.show_product', ['product' => $product]);
    }


    public function sync(Request $request, $order_id)
    {

        try {
            // Get the token from the environment variable
            $token = env("Kuin_token");

            // Find order items based on the order ID
            $response = Http::withToken($token)->get('https://kuin.summaict.nl/api/orderItem?order_id=' . $order_id);
            $orderItems = $response->json();

            foreach ($orderItems as $orderItem) {
                $productId = $orderItem['product_id'];
                $quantity = $orderItem['quantity'];

                // Check if the product already exists by querying the API
                $productResponse = Http::withToken($token)->get('https://kuin.summaict.nl/api/product/' . $productId);
                $productDetails = $productResponse->json();

                if ($productResponse->failed()) {
                    // Create a new product in the API with the ordered product details
                    $productDetails['article_number'] = $productId;
                    $productDetails['barcode'] = rand(100000000, 999999999);
                    $productDetails['stock'] = $quantity;

                    $createResponse = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
                        'X-CSRF-TOKEN' => csrf_token(),
                    ])->post(env('API_URL') . '/product', $productDetails);

                    if ($createResponse->failed()) {
                        // Handle the failure to create the product in the API
                        return redirect()->back()->with('error', 'Failed to create a new product in the API.');
                    }
                } else {
                    // Update the existing product in the API with the new details
                    $productDetails['stock'] += $quantity;

                    $updateResponse = Http::withHeaders([
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
                        'X-CSRF-TOKEN' => csrf_token(),
                    ])->put(env('API_URL') . '/product/' . $productId, $productDetails);

                    if ($updateResponse->failed()) {
                        // Handle the failure to update the product in the API
                        return redirect()->back()->with('error', 'Failed to update the existing product in the API.');
                    }
                }
            }

            // Return with a success message
            return redirect()->back()->with('success', 'Products synced successfully!');
        } catch (\Exception $e) {
            // Handle the exception
            // Log the error or display a friendly message to the user
            return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
        }
    }
}
