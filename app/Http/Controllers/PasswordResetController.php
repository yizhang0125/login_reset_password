<?php

namespace App\Http\Controllers;

use App\Mail\CustomMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.passwords.email'); // Ensure this view exists
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Create a unique token and store it in the database
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        
        $token = Str::random(60);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now()
        ]);

        $link = url('/password/reset/' . $token . '?email=' . urlencode($request->email));

        // Sending the reset link email
        $details = [
            'link' => $link,
            'message' => 'You have requested a password reset. Please follow the link in the email sent to you.'
        ];

        Mail::send('emails.customEmail', ['details' => $details], function ($message) use ($request) {
            $message->to($request->email)->subject('Reset Password');
        });

        return back()->with('success', 'We have sent you a link to reset your password');
    }

    public function showResetForm($token = null, Request $request)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        $reset = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$reset || !Hash::check($request->token, $reset->token)) {
            return back()->with('error', 'Invalid token');
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password reset successfully');
    }
}
