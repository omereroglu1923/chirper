<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // remember checkbox işaretliyse true, değilse false döner
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Session fixation'a karşı: giriş sonrası session ID'yi yenile
            $request->session()->regenerate();

            // Kullanıcıyı, login'e atılmadan önce gitmek istediği sayfaya geri gönder
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        // Şifreyi asla geri gönderme, sadece email'i old() ile geri getir
        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->onlyInput('email');
    }
}
