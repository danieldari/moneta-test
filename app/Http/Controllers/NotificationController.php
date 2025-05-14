<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
