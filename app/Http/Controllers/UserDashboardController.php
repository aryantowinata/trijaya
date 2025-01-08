<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use App\Models\Cart;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Orders::where('id_user', Auth::id())->count();
        $username = Auth::user()->username; // Ambil username pengguna yang login  
        return view('/user/home', compact('orders', 'username'));
    }

    public function daftar_produk()
    {
        $produks = Produk::all();
        $orderCount = Cart::where('id_user', Auth::id())->count();
        $username = Auth::user()->username; // Ambil username pengguna yang login  

        return view('/user/daftar_produk', compact('produks', 'orderCount', 'username'));
    }
}
