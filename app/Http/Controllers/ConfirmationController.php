<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function confirm($token)
    {
        $user = User::where('confirmation_token', $token)->first();

        if ($user) {
            // Mark the user as confirmed, update database, etc.
            $user->confirmed = true;
            $user->confirmation_token = null;
            $user->save();

            return view('confirmation.success');
        } else {
            return view('confirmation.error');
        }
    }
}
