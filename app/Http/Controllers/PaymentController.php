<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Product;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use App\Jobs\ProcessFinalPayment;
use App\Mail\PaymentConfirmation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function checkout($id)
    {
        $product = Product::findOrFail($id);
        // Use the authenticated user's email
        $email = Auth::user()->email;

        Stripe::setApiKey(env('STRIPE_SECRET'));

        // $paymentIntent = PaymentIntent::create([
        //     'amount' => $product->price * 100,
        //     'currency' => 'usd',
        //     'metadata' => ['integration_check' => 'accept_a_payment'],
        // ]);

        // for phase 3

        $paymentIntent = PaymentIntent::create([
            'amount' => ($product->price * 100) / 2, // Half the price
            'currency' => 'usd',
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);

        $clientSecret = $paymentIntent->client_secret;

        return view('checkout', compact('product', 'email', 'clientSecret'));
    }

    // public function process(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);

    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);

    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     $paymentIntent = PaymentIntent::create([
    //         'amount' => $product->price * 100,
    //         'currency' => 'usd',
    //         'metadata' => ['integration_check' => 'accept_a_payment'],
    //     ]);

    //     $output = [
    //         'clientSecret' => $paymentIntent->client_secret,
    //     ];

    //     return view('stripe', [
    //         'product' => $product,
    //         'email' => $request->email,
    //         'clientSecret' => $output['clientSecret'],
    //     ]);
    // }

    public function process(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'email' => 'required|email',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        // $paymentIntent = PaymentIntent::create([
        //     'amount' => $product->price * 100,
        //     'currency' => 'usd',
        //     'metadata' => ['integration_check' => 'accept_a_payment'],
        // ]);

            // for pahse 3
        $paymentIntent = PaymentIntent::create([
            'amount' => ($product->price * 100) / 2, // Half the price
            'currency' => 'usd',
            'metadata' => ['integration_check' => 'accept_a_payment'],
        ]);

        return redirect()->route('thankYou');

        // Assuming payment is successful, redirect to thank you page
        // return redirect()->route('thank.you')->with('email', $request->email);
    }

    public function thankYou(Request $request)
    {
        // dd('Thank You method called', $request->all());
        // Send confirmation email
        // $email = $request->email;
        // Mail::to($email)->send(new PaymentConfirmation($email)); // to user

        // for phase 3

        $email = $request->query('email');
        $productId = $request->query('product_id');

        // Ensure the product exists before proceeding
        $product = Product::find($productId);
        if (!$product) {
            Log::error("Product with ID $productId not found.");
            return redirect()->route('checkout')->withErrors(['error' => 'Product not found.']);
        }

        Mail::to($email)->send(new PaymentConfirmation($email));

        // Schedule the second payment in 5 minutes
        ProcessFinalPayment::dispatch($email, $productId)->delay(now()->addMinutes(5));

        return view('emails.thank_you');


        // return view('emails.thank_you');
    }
}
