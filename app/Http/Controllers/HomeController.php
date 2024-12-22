<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $users = User::where('role', 'user')->count();

        $produk = Produk::count();
        $orders = Orders::count();
        $orderBerhasil = Orders::where('status', 'completed')->sum('total_harga');


        $widget = [
            'users' => $users,
            'total_produk' => $produk,
            'orders' => $orders,
            'order_berhasil' => $orderBerhasil
        ];

        return view('home', compact('widget'));
    }
}
