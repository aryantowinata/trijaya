<?php

namespace App\Http\Controllers;

use App\Models\Orders;

use Illuminate\Http\Request;

class OrderManagementController extends Controller
{

    public function index()
    {
        // Mengambil semua produk
        $orders = Orders::all();
        $orders_data = Orders::with('user')->get();


        return view('history_order', compact('orders', 'orders_data'));
    }
}
