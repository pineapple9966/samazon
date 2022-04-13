<?php

namespace App\Services;

use App\Order;
use App\User;
use Illuminate\Http\Request;

class PaymentService
{
    private Request $request;
    private User $user;
    private \Stripe\StripeClient $stripe;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = $request->user();
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    /**
     * @return Order|\Illuminate\Database\Eloquent\Model
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function creditPayment()
    {
        if ($this->request['new_card']) {
            $response = $this->paymentByNewCard();
        } else {
            $response = $this->paymentByCustomerId();
        }

        return $this->createOrder($response['id']);
    }

    /**
     * @return Order|\Illuminate\Database\Eloquent\Model
     */
    public function cashPayment()
    {
        return $this->createOrder();
    }

    /**
     * @return \Stripe\PaymentIntent
     * @throws \Stripe\Exception\ApiErrorException
     */
    private function paymentByNewCard()
    {
        $paymentMethod = $this->createPaymentMethod();

        if ($this->request['card_save']) {
            $this->updateOrCreateCustomer($paymentMethod);
        }

        return $this->confirmPayment($paymentMethod);
    }

    /**
     * @return \Stripe\PaymentMethod
     * @throws \Stripe\Exception\ApiErrorException
     */
    private function createPaymentMethod()
    {
        return $this->stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => $this->request['number'],
                'exp_month' => $this->request['exp_month'],
                'exp_year' => $this->request['exp_year'],
                'cvc' => $this->request['cvc'],
            ],
            'billing_details' => [
                'email' => $this->user->email,
            ]
        ]);
    }

    /**
     * @param  \Stripe\PaymentMethod  $paymentMethod
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    private function updateOrCreateCustomer(\Stripe\PaymentMethod $paymentMethod)
    {
        if ($this->user->stripe_customer_id) {
            $this->updateCustomer($paymentMethod);
        } else {
            $this->createCustomer($paymentMethod);
        }
    }

    /**
     * @param  \Stripe\PaymentMethod  $paymentMethod
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    private function updateCustomer(\Stripe\PaymentMethod $paymentMethod)
    {
        $this->stripe->paymentMethods->detach($this->getCustomerPaymentMethod());

        $this->stripe->paymentMethods->attach(
            $paymentMethod->id,
            ['customer' => $this->user->stripe_customer_id]
        );
    }

    /**
     * @param  \Stripe\PaymentMethod  $paymentMethod
     *
     * @throws \Stripe\Exception\ApiErrorException
     */
    private function createCustomer(\Stripe\PaymentMethod $paymentMethod)
    {
        $customer = $this->stripe->customers->create([
            'email' => $this->user->email,
            'payment_method' => $paymentMethod,
        ]);

        $this->user->update(['stripe_customer_id' => $customer->id]);
    }

    /**
     * @return \Stripe\PaymentMethod|string
     * @throws \Stripe\Exception\ApiErrorException
     */
    private function getCustomerPaymentMethod()
    {
        $customerPaymentMethods = $this->stripe->paymentMethods->all([
            'customer' => $this->user->stripe_customer_id,
            'type' => 'card',
        ]);

        return $customerPaymentMethods['data'][0]['id'];
    }

    /**
     * @param  \Stripe\PaymentMethod|string  $paymentMethod
     *
     * @return \Stripe\PaymentIntent
     * @throws \Stripe\Exception\ApiErrorException
     */
    private function confirmPayment($paymentMethod)
    {
        $paymentIntent = $this->createPaymentIntent();

        return $this->stripe->paymentIntents->confirm(
            $paymentIntent->id,
            ['payment_method' => $paymentMethod]
        );
    }

    /**
     * @return \Stripe\PaymentIntent
     * @throws \Stripe\Exception\ApiErrorException
     */
    private function createPaymentIntent()
    {
        $params =  [
            'amount' => $this->request['amount'],
            'currency' => 'jpy',
            'payment_method_types' => ['card'],
        ];

        if ($this->user->stripe_customer_id) {
            $params['customer'] = $this->user->stripe_customer_id;
        }

        return $this->stripe->paymentIntents->create($params);
    }

    /**
     * @return \Stripe\PaymentIntent
     * @throws \Stripe\Exception\ApiErrorException
     */
    private function paymentByCustomerId()
    {
        return $this->confirmPayment($this->getCustomerPaymentMethod());
    }

    /**
     * @param  string|null  $paymentIntentId
     *
     * @return Order|\Illuminate\Database\Eloquent\Model
     */
    public function createOrder($paymentIntentId = null)
    {
        return Order::create([
            'user_id' => $this->request->user()->id,
            'payment_intent_id' => $paymentIntentId,
            'total_amount' => $this->request['amount'],
        ]);
    }
}
