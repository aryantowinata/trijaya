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

        // Tentukan informasi VA Name dan VA Number (misalnya, menggunakan BCA dan nomor VA sementara)
        $payment_va_name = 'CIBAI'; // Bisa disesuaikan dengan bank atau metode pembayaran yang digunakan
        $payment_va_number = '123'; // Nomor VA sementara, nantinya akan diperbarui oleh Midtrans

        // Buat order baru
        $order = Orders::create([
            'id_user' => Auth::id(),
            'total_harga' => $total_harga,
            'status' => 'pending',
            'payment_va_name' => $payment_va_name,
            'payment_va_number' => $payment_va_number,
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
        $serverKey = config('midtrans.server_key');
        // Proses callback dari Midtrans
        $notification = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);


        if ($notification == $request->signature_key) {
            if ($request->transaction_status == 'settlement') {
                $order = Orders::find($request->order_id);
                $order->update(['status' => 'completed']);
            } elseif ($request->transaction_status == 'pending') {
                $order = Orders::find($request->order_id);
                $order->update(['status' => 'pending']);
            } elseif ($request->transaction_status == 'cancel') {
                $order = Orders::find($request->order_id);
                $order->update(['status' => 'cancel']);
            }

            if (isset($request->va_number)) {
                // Update informasi VA pada tabel orders
                $order->update([
                    'payment_va_name' => $request->bank,
                    'payment_va_number' => $request->va_number,
                ]);
            }
        }


        return response()->json(['status' => 'success']);
    }
}
