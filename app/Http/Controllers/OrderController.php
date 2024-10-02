<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil semua pesanan untuk pengguna yang sedang login
        $orders = Orders::where('id_user', auth()->id())->with('items')->get();

        // Tampilkan view dengan data pesanan
        return view('user.orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Ambil detail pesanan berdasarkan ID
        $order = Orders::with('items')->findOrFail($id);

        // Tampilkan view dengan data detail pesanan
        return view('user.orders.show', compact('order'));
    }
}
