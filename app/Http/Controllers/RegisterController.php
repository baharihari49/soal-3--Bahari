<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Tambahkan use statement untuk Validator
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        return view("auth.register");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255|regex:/^\S.*\S$/',
            'email' => 'required|email|unique:users,email',
            'number_phone' => 'required|regex:/^08[0-9]{8,15}$/',
            'password' => 'required|min:8|regex:/^\S.*\S$/',
            'password_confirmation' => 'required|same:password',
        ], [
            'name.regex' => 'Nama tidak boleh diawali atau diakhiri dengan spasi.',
            'number_phone.regex' => 'Nomor HP harus diawali dengan 08 dan hanya berisi angka.',
            'password.regex' => 'Password tidak boleh diawali atau diakhiri dengan spasi.',
            'password_confirmation.same' => 'Konfirmasi password harus sama dengan password.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number_phone' => $request->number_phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/');
    }
}
