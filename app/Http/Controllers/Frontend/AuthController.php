<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ForgotPasswordRequest;
use App\Http\Requests\Frontend\LoginRequest;
use App\Http\Requests\Frontend\SignupRequest;
use App\Models\User;
use Arr;
use Auth;
use Hash;
use Illuminate\Http\Request;
use JsValidator;

class AuthController extends Controller
{

    public function login()
    {
        Auth::guard('user')->logout();
        $validator = JsValidator::formRequest('App\Http\Requests\Frontend\LoginRequest', '#loginForm');
        return view('frontend.login', compact('validator'));
    }
    public function signup()
    {
        $validator = JsValidator::formRequest('App\Http\Requests\Frontend\SignupRequest', '#signupForm');
        return view('frontend.signup', compact('validator'));
    }

    public function loginProcess(LoginRequest $request)
    {
        $validated_data = $request->validated();
        $user = User::where('email', $validated_data['email'])->first();

        if ($user) {
            $login = Auth::guard('user')->attempt($request->only(['email', 'password']));

            if ($login) {
                return redirect(route('frontend.home'));
            }
        }
        return back()->with('error', 'Wrong login credentials');
    }
    public function signupProcess(SignupRequest $request)
    {
        $validated_data = $request->validated();
        $validated_data['password'] = Hash::make($validated_data['password']);

        if ($validated_data['refer-code']) {
            $refer_user = User::where(['refer_code' => $validated_data['refer-code']])->first();
            if ($refer_user) {
                $validated_data['refer_user_id'] = $refer_user->id;
            }
        }

        $user = User::create($validated_data);

        if ($user) {
            $login = Auth::guard('user')->attempt($request->only(['email', 'password']));

            if ($login) {
                return redirect(route('frontend.home'));
            }
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::guard('user')->logout();
        }

        return redirect(route('frontend.home'));
    }

    public function forgotPassword(Request $request)
    {
        $validator = JsValidator::formRequest('App\Http\Requests\Frontend\ForgotPasswordRequest', '#forgotPasswordForm');
        return view('frontend.forgot_password', compact('validator'));
    }

    public function forgotPasswordProcess(ForgotPasswordRequest $request)
    {
        $validated_data = $request->validated();
        dd($validated_data);
    }
}
