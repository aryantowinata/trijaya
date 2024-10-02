<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use App\Models\Cart;
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
        return view('/user/home');
    }


    public function daftar_produk()
    {
        $produks = Produk::all();
        $orderCount = Cart::where('id_user', Auth::id())->count();


        return view('/user/daftar_produk', compact('produks', 'orderCount'));
    }





    // public function cancelOrder($id)
    // {
    //     // Temukan order berdasarkan ID
    //     $cart = Cart::findOrFail($id);

    //     // Pastikan order milik user yang sedang login
    //     if ($cart->id_user !== Auth::id()) {
    //         return redirect()->back()->with('error', 'Anda tidak berhak membatalkan order ini.');
    //     }

    //     // Update status cart menjadi 'canceled'
    //     $cart->status = 'canceled';
    //     $cart->delete();

    //     // Redirect kembali dengan pesan sukses
    //     return redirect()->route('user.orders')->with('success', 'Order berhasil dibatalkan.');
    // }
}
