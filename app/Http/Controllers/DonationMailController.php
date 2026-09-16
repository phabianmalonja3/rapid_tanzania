<?php

namespace App\Http\Controllers;

use App\Mail\DonationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DonationMailController extends Controller
{
    public function send(Request $request)
    {
        // Validate inputs
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'amount' => 'required',
            'method' => 'required',
            'message' => 'nullable'
        ]);

        // Send the email
        Mail::to("info@rapidtanzania.org")->send(new DonationMail($request->all()));

        return response()->json([
            'status' => 'success',
            'message' => 'Donation email sent successfully.'
        ]);
    }
}
