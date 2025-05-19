<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NotificationController extends Controller
{
    public function send(Request $request)
{
    $validated = $request->validate([
        'notification_type' => 'required|in:email,sms,whatsapp',
        'email' => 'nullable|email|required_if:notification_type,email',
        'phone' => 'nullable|string|required_if:notification_type,sms,whatsapp',
        'title' => 'required|string',
        'body' => 'required|string',
    ]);

    // Dispatch logic here (send email, SMS API, WhatsApp API, etc.)

    return back()->with('success', 'Notification sent successfully!');
}






        function generateBase64($service) {
            $Client_id='95e5b6dd5f9669bcaa25855cfdfd5a531940f3825688c11d8a94eae4526f1cc6f223d52e1aa53655d3f446ca169e930b6265a5f9bb8939369ed407f42a1ee9b3';
            $Client_Secret='A9oTZFjtcfkKC0hFdOjOSCnvXolgHGvUVOTTDg9';
            $string_to_encode = $Client_id . ':' . $Client_Secret . ':' . $service;

            $based= base64_encode($string_to_encode);



           $respond= Http::withHeaders([
                'X-Auth-Token'=>$based
            ])
            ->post('https://api.moneta.ng/api/v2/generate-access-token');

            return $respond->json();
        }

       /** @test */
        public function test_function()
        {
            // Moneta Notification
            $service='mnt_LtC4sBt4ppLaAHd7mm1YiHgoLby5hb';
            // assertions
            return $this->generateBase64($service);

        }
}
