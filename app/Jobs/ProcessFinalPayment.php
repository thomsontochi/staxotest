<?php

namespace App\Jobs;

use Stripe\Stripe;
use App\Models\Product;
use Stripe\PaymentIntent;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\FinalPaymentConfirmation;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessFinalPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $productId;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $productId)
    {
        $this->email = $email;
        $this->productId = $productId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            $product = Product::findOrFail($this->productId);

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $paymentIntent = PaymentIntent::create([
                'amount' => ($product->price * 100) / 2, // Second half of the price
                'currency' => 'usd',
                'metadata' => ['integration_check' => 'final_payment'],
                'capture_method' => 'automatic',
            ]);

            Log::info('Second payment initiated for product ID: ' . $this->productId);

            // Assuming payment succeeds automatically, in real-world, we might need to confirm the payment intent again
            Mail::to($this->email)->send(new FinalPaymentConfirmation($this->email));

            Log::info('Final payment email sent to: ' . $this->email);
        } catch (\Exception $e) {
            Log::error('Error processing final payment: ' . $e->getMessage());
            throw $e;
        }
    }
}
