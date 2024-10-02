<?php

namespace App\Http\Controllers;

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
        $users = User::count();
        $produk = Produk::count();

        $widget = [
            'users' => $users,
            'total_produk' => $produk,
        ];

        return view('home', compact('widget'));
    }
}
