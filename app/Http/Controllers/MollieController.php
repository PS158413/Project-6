<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
    public function payment($order_id)
    {
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey('test_y9dF6mjN5hB678wgru3g9zmFzeaf8n');
        $order = Order::findOrFail($order_id);

        $payment = $mollie->payments->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => '10.00',
            ],
            'description' => 'Order ' . $order->id,
            'redirectUrl' => URL::to('order/success/'. $order->id),
        ]);

        return redirect()->route('order.success');
    }

}
