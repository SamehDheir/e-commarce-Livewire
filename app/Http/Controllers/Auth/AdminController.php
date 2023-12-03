<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.dashboard");
    }

    public function login_form()
    {
        return view("admin.login");
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            "email" => "required|email|exists:admins",
            "password" => "required",
        ]);

        $credentials = $request->only('email', 'password');
        // Hash::make('password')
        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed
            return redirect()->route('admin.dashboard')->with('success', 'Login Successfuly');
        }
        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login_form')->with('logout', 'Log Out Successfuly');
    }
}
