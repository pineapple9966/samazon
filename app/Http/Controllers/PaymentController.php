<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PurchaseHistory;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        try {
            $paymentIntent = $stripe->paymentIntents->create([
                'customer' => $request->user()->stripe_customer_id,
                'amount' => $request['amount'],
                'currency' => 'jpy',
                'payment_method_types' => ['card'],
            ]);

            $customerPaymentMethods = $stripe->paymentMethods->all([
                'customer' => $request->user()->stripe_customer_id,
                'type' => 'card',
            ]);

            $paymentMethod = $customerPaymentMethods['data'][0]['id'];

            $response = $stripe->paymentIntents->confirm(
                $paymentIntent->id,
                ['payment_method' => $paymentMethod]
            );
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'status' => 'failed',
                'stripeCode' => $e->getStripeCode(),
                'message' => $e->getMessage()
            ]);
        }

        $order = Order::create([
            'payment_intent_id' => $response['id'],
            'user_id' => $request->user()->id,
            'total_amount' => $request['amount'],
        ]);

        foreach ($request->user()->carts as $cart) {
            PurchaseHistory::create([
                'order_id' => $order->id,
                'product_id' => $cart->product->id,
                'qty' => $cart->qty,
                'amount' => $cart->sum(),
            ]);
        }

        $request->user()->carts()->delete();

        return response()->json(['status' => 'succeeded']);
    }
}
