<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'unique:users',
            'password' => 'confirmed',
        ], [
            'email.unique' => '使用済みメールアドレスです',
            'password.confirmed' => 'パスワードが一致しません',
        ]);

        $attributes = $request->all();

        $attributes['password'] = Hash::make($attributes['password']);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect()->route('home');
    }
}
