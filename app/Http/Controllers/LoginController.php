<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login'); // Mengembalikan tampilan form login
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        // Menggunakan Auth::attempt() untuk memeriksa email dan password
        // Parameter kedua adalah opsi 'remember' jika checkbox "Ingat Saya" dicentang
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Jika sukses, redirect ke halaman index barang
            return redirect()->route('barang.index'); // Ganti dengan route yang sesuai
        }

        // Jika gagal, kirim kembali ke form dengan error
        return back()->with('error', 'Email atau password salah.')->withInput($request->only('email')); // Mengembalikan input email
    }
}
