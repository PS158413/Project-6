<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        $page = $request->input('page', 1);

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/category/all?page='. $page);

        if ($response->failed()) {
            abort(500, 'Failed to retrieve users from API');
        }

        $categories = $response->json()['data'];




        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {

        $page = $request->input('page', 1);

        // Send a request to fetch the products for the view
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/product/all?page='. $page);

        if ($response->failed()) {
            abort(500, 'Failed to fetch products via API');
        }

        $data = $response->json();

        $products = $data['data']['data'];


        return view('categories.create', compact('products','page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id = null)
    {

        // Send a request to create the category via the API if $id is not provided
        if (is_null($id)) {

            // Validate the request data
            $validatedData = $request->validate([
                'category' => 'required',
                'name' => 'nullable|array',
            ]);




            // Get the category and names from the validated data
            $category = $validatedData['category'];
            $names = $validatedData['name'] ?? [];


            // Loop through the names and create categories
            foreach ($names as $name) {
                // Create the category data array
                $categoryData = [
                    'category' => $category,
                    'name' => $name,
                ];


                // Send a request to create the category via the API if $id is not provided

                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
                    'X-CSRF-TOKEN' => csrf_token(),
                ])->post(env('API_URL') . '/category', $categoryData);


                if ($response->failed()) {
                    abort(500, 'Failed to create the category via API');
                }
            }

            // Redirect back to the create view with a success message
            return redirect()->route('categories.index')->with('success', 'Categories created successfully.');
        } else {

            // Validate the request data
            $validatedData = $request->validate([
                'category' => 'required',
                'name' => 'required',
            ]);

            $productData = [

                'category' => $validatedData['category'],
                'name' => $validatedData['name'],

            ];

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
                'X-CSRF-TOKEN' => csrf_token(),
            ])->post(env('API_URL') . '/category', $productData);


            if ($response->failed()) {
                abort(500, 'Failed to create the category via API');
            }
            return redirect()->route('category.show', ['id' => $id])->with('success', 'Product successfully assigned toe Category.');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {


        // Send a request to fetch the products for the view
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/product/all?page=');

        if ($response->failed()) {
            abort(500, 'Failed to fetch products via API');
        }



        $products = $response->json()['data']['data'];




        // Send a request to fetch the category for the view
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/category/' . $id);


        if ($response->failed()) {
            abort(500, 'Failed to fetch products via API');
        }

        $category = $response->json()['data'];



        $matchingProductNames = collect($category['products'])->pluck('name');
        $filteredProducts = collect($products)->reject(function ($product) use ($matchingProductNames) {
            return $matchingProductNames->contains($product['name']);
        });



        return view('categories.show', compact('category', 'filteredProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detach(Request $request, $id)
    {



        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
        ]);



        $productData = [
            'name' => $validatedData['name'],
        ];




        // Send a request to fetch the category for the view
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->delete(env('API_URL') . '/category/detach/' . $id, $productData);


        // $category = $response->json();

        // dd($category);



        if ($response->failed()) {
            abort(500, 'Failed to fetch products via API');
        }

        return redirect()->route('category.show', ['id' => $id])->with('success', 'Product successfully detach from Category.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {



          // Validate the request data
        $validatedData = $request->validate([
            'category' => 'required',
        ]);



        $categoryData = [
            'category' => $validatedData['category'],
        ];




         $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->put(env('API_URL') . '/category/' . $id, $categoryData);

            //  $category = $response->json();

            //  dd($category);

        if ($response->failed()) {
            abort(500, 'Failed to fetch products via API');
        }

        return redirect()->route('category.show', ['id' => $id])->with('success', 'Category successfully updated.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->delete(env('API_URL') . '/category/' . $id);

        if ($response->failed()) {
            abort(500, 'Failed to fetch products via API');
        }

        return redirect()->route('categories.index')->with('success', 'Categories deleted successfully.');
    }
}
