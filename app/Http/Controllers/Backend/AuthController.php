<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JsValidator;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function showLoginForm()
    {
        $validator = JsValidator::formRequest('App\Http\Requests\Backend\LoginRequest', '#loginForm');
        return view('backend.login', compact('validator'));
    }

    public function loginProcess(LoginRequest $request)
    {
        $validated = $request->validated();

        $admin = Admin::where('email', $validated['email'])->first();

        if ($admin) {
            if (Hash::check($validated['password'], $admin->password)) {
                $admin = Auth::guard('admin')->attempt($validated);
                return redirect()->route('backend.home');
            }
        }
        return back()->with('error', 'Wrong loggin credential');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('backend.show_login_form'));
    }
}
