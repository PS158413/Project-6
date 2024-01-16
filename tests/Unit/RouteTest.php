<?php

namespace Tests\Unit;

use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // test of elke route bestaat
    public function test_home_route()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_contact_route()
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
    }

    public function test_about_route()
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    public function test_cart_route()
    {
        $response = $this->get('/cart');

        $response->assertStatus(200);
    }

    public function test_products_route()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    public function test_product_route()
    {
        $response = $this->get('/product/5');

        // check of € teken in de prijs staat
        $response->assertSeeText('€');

        $response->assertStatus(200);
    }

    public function test_login_route()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_register_route()
    {
        $response = $this->get('/register');

        // check assertsee
        $response->assertSeeText('Register');
        $response->assertSeeText('Name');
        $response->assertSeeText('Email');
        $response->assertSeeText('Password');
        $response->assertStatus(200);
    }

    public function test_profile_route()
    {
        $response = $this->get('/profile');

        $response->assertStatus(302);
    }

    public function test_dashboard_route()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
    }

    public function test_admin_route()
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
    }

    //check if user is logged in
    public function test_user_logged_in()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertStatus(200);
    }
}
