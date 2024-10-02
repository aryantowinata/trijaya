<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Orders; // Pastikan Anda menggunakan model Order
use App\Models\OrderItem; // Pastikan Anda memiliki model ini
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Ambil keranjang yang dimiliki pengguna saat ini
        $carts = Cart::where('id_user', Auth::id())->get();

        // Hitung total harga dari keranjang
        $total_harga = 0;
        foreach ($carts as $cart) {
            $total_harga += $cart->produk->harga_produk * $cart->jumlah;
        }

        // Buat order baru
        $order = Orders::create([
            'id_user' => Auth::id(),
            'total_harga' => $total_harga,
            'status' => 'pending', // Atur status sesuai kebutuhan
        ]);

        // Buat order items dari keranjang
        foreach ($carts as $cart) {
            OrderItem::create([
                'id_orders' => $order->id,
                'id_produk' => $cart->id_produk,
                'jumlah' => $cart->jumlah,
                'harga_satuan' => $cart->produk->harga_produk,
            ]);
        }

        // Hapus keranjang setelah checkout
        Cart::where('id_user', Auth::id())->delete();

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');

        // Persiapkan data untuk pembayaran
        $transactionDetails = [
            'order_id' => $order->id,
            'gross_amount' => $total_harga,
        ];

        $itemDetails = [];
        foreach ($carts as $cart) {
            $itemDetails[] = [
                'id' => $cart->id_produk,
                'price' => $cart->produk->harga_produk,
                'quantity' => $cart->jumlah,
                'name' => $cart->produk->nama_produk,
            ];
        }

        $midtransTransaction = [
            'payment_type' => 'credit_card', // Anda bisa menyesuaikan dengan jenis pembayaran yang lain
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        // Dapatkan URL untuk pembayaran
        $snapToken = Snap::getSnapToken($midtransTransaction);

        // Redirect ke halaman Midtrans
        return view('/user/midtrans', compact('snapToken'));
    }


    public function midtransCallback(Request $request)
    {
        // Proses callback dari Midtrans
        $notification = new \Midtrans\Notification($request->all());

        // Temukan order berdasarkan order_id
        $order = Orders::find($notification->id_orders);

        // Update status pesanan berdasarkan status dari Midtrans
        if ($notification->transaction_status == 'settlement') {
            $order->update(['status' => 'completed']);
        } elseif ($notification->transaction_status == 'pending') {
            $order->update(['status' => 'pending']);
        } elseif ($notification->transaction_status == 'cancel' || $notification->transaction_status == 'expire') {
            $order->update(['status' => 'canceled']);
        }

        return response()->json(['status' => 'success']);
    }
}
