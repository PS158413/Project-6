<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class ProductControllerG extends Controller
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


        return view('products.index', compact('products', 'page', 'nextPageUrl', 'currentpage', 'lastpage'));
    }
}
