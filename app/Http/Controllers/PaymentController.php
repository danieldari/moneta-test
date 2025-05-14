<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public $Token =env('MONETA_TOKEN');
    public $Secret_key =env('MONETA_MAC');
    public $Splite =env('MONETA_SPLIT');

    public function submit(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email',
            'amount' => 'required|numeric|min:0.01',
        ]);

        // Simulate payment logic or save to database
        // Example: Store payment info in session for now
        session()->flash('payment_info', $validated);

        return back()->with('success', 'Payment submitted successfully!');
    }



        protected function generateHash($email, $amount, $callback_url)
        {
            // Amount must be in Kobo
            // Card or bank
            // Where we will redirect back to or notify your systems
            // Secret key from Moneta
            $secret_key=$this->Secret_key;
            $mac = $secret_key;
            // Amount in kobo (#500 === 50000k)
            $payment_type="card";

            $mystring = $email . $amount . $payment_type . $callback_url;
            $hash = hash_hmac('sha512', $mystring, $mac, false);
            return $hash;
        }


        public function initiatPayment(Request $request){
            // Some code
            $validated = $request->validate([
            'email'  => 'required|email',
            'amount' => 'required|numeric|min:0.01',
            // 'callback_url' => 'required|url',
            ]);

            $callback_url=route('payment.verify');
            $hash = $this->generateHash($validated['email'], $validated['amount'],  $callback_url);

            $url = 'https://app.moneta.ng/api/v1/transaction/initialize';

            $payload = [
            "amount" => $validated['amount'] * 100, //amount in kobo
            "email" => $validated['email'],
            "callback_url" => $callback_url,
            "payment_type" => "card",
            "channel" => "card",
            "metadata"=>"",
            "customerinfo"=> "",
            "serviceCode"=> "", //
            "serviceType"=> '', // What are you paying for
            "serviceCategory"=>'', // category of service
            "json" => "true",
            "use_split" => $this->Splite, //i need this
            ];



            try {
            $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            ])->post($url, array_merge($payload, ['hash' => $hash]));


            return $response->body();

            } catch (\Exception $e) {
                Log::error("error" .$e->getMessage());
            // Handle exception (e.g., log error, return error message)
            return response()->json(['error' => $e->getMessage()], 500);
            }
        }

            public function verifyPayment(Request $request, $reference)
             {
                // $validated = $request->validate([
                // 'channel' => 'required|string',
                // 'token' => 'required|string',
                // ]);

                $channel = "card";
                $token = $this->Token;

                $url = "https://app.moneta.ng/api/v1/transaction/verify/{$channel}/{$reference}";

                try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ])->get($url);

                return $response->body();

                } catch (\Exception $e) {
                // Handle exception (e.g., log error, return error message)
                return response()->json(['error' => $e->getMessage()], 500);
                }
            }


        }
