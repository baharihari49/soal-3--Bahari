<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validasi input dari formulir
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:8|regex:/^\S.*\S$/',
        ], [
            'email.required' => 'Kolom email wajib diisi.',
            'email.string' => 'Kolom email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Panjang email maksimal :max karakter.',
            'password.required' => 'Kolom password wajib diisi.',
            'password.min' => 'Panjang password minimal :min karakter.',
            'password.regex' => 'Password tidak boleh memiliki spasi di awal atau akhir.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Otentikasi pengguna
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect('/');
        }

        // Jika otentikasi gagal karena email tidak ditemukan, tambahkan pesan kesalahan
        return redirect()->back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
