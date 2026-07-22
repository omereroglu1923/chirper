<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    public function __invoke(Request $request)
    {
        // confirmed: password_confirmation alanıyla otomatik karşılaştırır
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Şifre asla düz metin saklanmaz, Hash::make ile geri döndürülemez şekilde şifrelenir
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Kayıt + otomatik giriş: kullanıcıyı hemen oturum açmış say
        Auth::login($user);

        return redirect('/')->with('success', 'Welcome to Chirper!');
    }
}
