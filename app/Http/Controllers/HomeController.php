<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $token = env('Api_token');
        $categoriesResponse = Http::withToken($token)->get('http://nickvanhooff.com/api_gv/public/api/category/all');
        $productsResponse = Http::withToken($token)->get('http://nickvanhooff.com/api_gv/public/api/product/all');

        if ($productsResponse->ok() && $categoriesResponse->ok()) {
            $data = $productsResponse->json()['data'];
            $categories = $categoriesResponse->json();

            // dd($categories);
            if (! empty($data) && ! empty($categories)) {
                $Homecategories = $categories['data'];
                $Homeproducts = $data['data'];

                $selectedRoleId = $request->input('category');

                // Filter the user data based on the selected role
                if ($selectedRoleId) {
                    $Homeproducts = array_filter($Homeproducts, function ($products) use ($selectedRoleId) {
                        foreach ($products['category'] as $category) {
                            if ($category['id'] == $selectedRoleId) {
                                return true;
                            }
                        }

                        return false;
                    });
                }

                // Limit the number of products per category to 5
                $Homeproducts = array_slice($Homeproducts, 0, 5, true);

                return view('index', ['Homeproducts' => $Homeproducts, 'Homecategories' => $Homecategories, 'selectedCategoryId' => $selectedRoleId]);
            } else {
                $message = 'Er zijn geen producten of categorien.';

                return view('index', ['message' => $message]);
            }
        } else {
            abort(500, 'Failed to fetch products or categories from API');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
