<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
 class ProductsControllerTest extends TestCase
{
    public function test_Index()
    {
        // Mock the HTTP response
        $response = Http::fake([
            '*' => Http::response([
                'data' => [
                    'data' => [
                        // Mock product data
                    //    add product with all fields
                        [
                            'id' => 1,
                            'name' => 'Product 1',
                            'description' => 'Product 1 description',
                            'price' => 100,
                            'image' => 'product1.jpg',
                            'created_at' => '2021-01-01 00:00:00',
                            'updated_at' => '2021-01-01 00:00:00'
                        ],
                        // add product with all fields
                        [
                            'id' => 2,
                            'name' => 'Product 2',
                            'description' => 'Product 2 description',
                            'price' => 200,
                            'image' => 'product2.jpg',
                            'created_at' => '2021-01-01 00:00:00',
                            'updated_at' => '2021-01-01 00:00:00'
                        ],
                        // add product with all fields
                        [
                            'id' => 3,
                            'name' => 'Product 3',
                            'description' => 'Product 3 description',
                            'price' => 300,
                            'image' => 'product3.jpg',
                            'created_at' => '2021-01-01 00:00:00',
                            'updated_at' => '2021-01-01 00:00:00'

                        ],
                        ],
                    ],
            ], 200)
        ]);
         // Set the session API bearer token
        Session::put('SESSION_API_BEARER_TOKEN', 'your_bearer_token');
         // Call the index method
        $response = $this->get('/products');
         // Assert that the response was successful
        $response->assertStatus(200);


    }
     public function test_IndexFailedApiRequest()
    {
        // Mock the HTTP response to simulate a failed request
        $response = Http::fake([
            '*' => Http::response([], 500)
        ]);
         // Set the session API bearer token
        Session::put('SESSION_API_BEARER_TOKEN', 'your_bearer_token');
         // Call the index method
        $response = $this->get('/products');
         // Assert that the response has a 500 status code
        $response->assertStatus(500);
         // Assert that the proper error message is displayed
        $response->assertSeeText('Failed to retrieve products from API');
    }
}
