<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; // Pastikan menambahkan ini untuk akses ke Auth

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect users after login based on their role.
     *
     * @return string
     */
    protected function redirectTo()
    {
        // Memeriksa role pengguna setelah login
        if (Auth::user()->role === 'admin') {
            return '/home'; // Redirect ke dashboard admin
        } else {
            return '/user/home'; // Redirect ke dashboard user
        }
    }
}
