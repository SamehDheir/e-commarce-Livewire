<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Categories;
use App\Models\Contact;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.dashboard", [
            'categoryCount' => Categories::count(),
            'productCount' => Products::count(),
            'contactCount' => Contact::count(),
            'userCount' => User::count(),
            'blogsCount' => Blogs::count(),
        ]);
    }

    public function login_form()
    {

        if (!Auth::guard('admin')->check()) {
            return view("admin.login");
        } else {
            return redirect()->route("admin.dashboard");
        }
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            "email" => "required|email|exists:admins",
            "password" => "required",
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed
            return redirect()->route('admin.dashboard')->with('success', 'Login Successfully');
        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login_form')->with('logout', 'Log Out Successfuly');
    }
}
