<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    public function test_product_create()
    {
        $response = $this->get('/products/create');

        $response->assertStatus(200);
    }
}
