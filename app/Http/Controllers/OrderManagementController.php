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
        // dd($orders);


        return view('history_order', compact('orders', 'orders_data'));
    }

    public function destroy($id)
    {
        $orders = Orders::findOrFail($id);
        $orders->delete();

        return redirect()->route('history_order.index')->with('success', 'orders berhasil dihapus.');
    }

    public function show($id)
    {
        // Ambil order berdasarkan id
        $order = Orders::with(['user', 'items.produk'])->findOrFail($id);

        return view('order_detail', compact('order'));
    }
}
