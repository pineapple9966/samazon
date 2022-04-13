<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard()->attempt($credentials)) {
            return $this->authenticated($request, Auth::guard()->user());
        }

        throw ValidationException::withMessages([
            'email' => ['メールアドレスまたはパスワードに誤りがあります']
        ]);
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->deleted_at) {
            Auth::guard()->logout();

            throw ValidationException::withMessages([
                'email' => ['退会済みのアカウントです！']
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
