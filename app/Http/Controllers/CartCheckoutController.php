<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Mollie\Api\MollieApiClient;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CartCheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;

        // Create the order
        $order = new Order();
        $order->name = $name;
        $order->email = $email;
        $order->phone = $phone;
        $order->address = $address;
        $order->save();

        // Create the order items
        if (session()->has('cart')) {
            $cartItems = session('cart');
            foreach ($cartItems as $id => $details) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $id;
                $orderItem->quantity = $details['quantity'];
                $orderItem->status = 'paid';
                $orderItem->save();

            }
        }

        // Calculate the order amount
        $orderAmount = $this->calculateOrderAmount($cartItems);

        // Create a payment with Mollie
        $mollie = new MollieApiClient();
        $mollie->setApiKey('test_y9dF6mjN5hB678wgru3g9zmFzeaf8n');

        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format($orderAmount / 100, 2),
            ],
            "description" => "Order payment",
            "redirectUrl" => route('order.success', ['order' => $order->id]),
        ]);

        session()->forget('cart');

        // Redirect the user to the Mollie payment page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success(Order $order)
    {
        return view('order.success', compact('order'));
    }

    /**
     * Calculate the total order amount based on the items in the cart.
     *
     * @param array $cartItems
     * @return int
     */
    private function calculateOrderAmount($cartItems)
    {
        $totalAmount = 0;

        foreach ($cartItems as $id => $details) {
            $token = env('Api_token');
            $response = Http::withToken($token)->get('http://nickvanhooff.com/api_gv/public/api/product/' . $id);
            $product = $response->json()['data'];
            $totalAmount += $product['price'] * $details['quantity'];
        }
        $totalAmountCents = $totalAmount * 100;

        return max($totalAmountCents, 50);

    }


}
