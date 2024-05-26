<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        // Send the email
        Mail::to('ahmedbahij0@gmail.com')->send(new ContactMail($validated));

        // Redirect or respond as needed
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
