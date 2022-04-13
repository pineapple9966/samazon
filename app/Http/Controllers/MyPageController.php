<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MyPageController extends Controller
{
    public function index()
    {
        return view('mypage.index');
    }

    public function profileEdit()
    {
        return view('mypage.profile.edit');
    }

    public function profileUpdate(Request $request)
    {
        foreach (['name', 'email', 'phone'] as $fieldName) {
            if ($request->has($fieldName)) {
                if ($fieldName === 'email') {
                    $request->validate([
                        'email' => 'unique:users',
                    ], [
                        'email.unique' => '使用済みメールアドレスです',
                    ]);
                }

                $request->user()->update([$fieldName => $request[$fieldName]]);
            }
        }

        return redirect()->route('mypage.profile.edit');
    }

    public function userDestroy(Request $request)
    {
        $request->user()->update(['deleted_at' => Carbon::now()]);

        return redirect()->route('logout');
    }

    public function addressEdit()
    {
        return view('mypage.address.edit');
    }

    public function addressUpdate(Request $request)
    {
        $request->validate([
            'email' => 'unique:users',
        ], [
            'email.unique' => '使用済みメールアドレスです',
        ]);

        $request->user()->update($request->all());

        return redirect()->route('mypage.address.edit');
    }

    public function passwordEdit()
    {
        return view('mypage.password.edit');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'confirmed',
        ], [
            'password.confirmed' => 'パスワードが一致しません',
        ]);

        $request->user()->update(['passowrd' => Hash::make($request['password'])]);

        return redirect()->route('mypage.index');
    }

    public function createCreditCard()
    {
        return view('mypage.credit_card.create');
    }

    public function storeCreditCard(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        try {
            $paymentMethod = $stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                    'number' => $request['number'],
                    'exp_month' => $request['exp_month'],
                    'exp_year' => $request['exp_year'],
                    'cvc' => $request['cvc'],
                ],
                'billing_details' => [
                    'email' => $request->user()->email,
                ]
            ]);

            $customer = $stripe->customers->create([
                'email' => $request->user()->email,
                'payment_method' => $paymentMethod,
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'status' => 'failed',
                'stripeCode' => $e->getStripeCode(),
                'message' => $e->getMessage()
            ]);
        }

        $request->user()->update(['stripe_customer_id' => $customer->id]);

        return response()->json(['status' => 'succeeded']);
    }

    public function orders(Request $request)
    {
        $orders = $request->user()->orders()->paginate(10);

        return view('mypage.orders.index', compact('orders'));
    }

    public function purchaseHistory(Order $order)
    {
        return view('mypage.orders.show', compact('order'));
    }
}
