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
            'status' => 'pending',
            'payment_va_name' => '', // Akan diperbarui oleh Midtrans
            'payment_va_number' => '', // Akan diperbarui oleh Midtrans
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

        // Tambahkan timestamp ke order_id untuk membuatnya unik
        $orderId = $order->id . '-' . time();

        // Persiapkan data untuk pembayaran
        $transactionDetails = [
            'order_id' => $orderId,
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
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        // Dapatkan URL untuk pembayaran
        $snapToken = Snap::getSnapToken($midtransTransaction);

        // Simpan order_id Midtrans ke dalam database
        $order->update(['order_id' => $orderId]);

        // Redirect ke halaman Midtrans
        return view('/user/midtrans', compact('snapToken'));
    }




    public function midtransCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        // Validasi signature key dari Midtrans
        $signatureKey = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($signatureKey === $request->signature_key) {
            $order = Orders::find($request->order_id);

            if ($order) {
                // Update status order berdasarkan status transaksi
                if ($request->transaction_status === 'settlement') {
                    $order->update(['status' => 'completed']);
                } elseif ($request->transaction_status === 'pending') {
                    $order->update(['status' => 'pending']);
                } elseif ($request->transaction_status === 'cancel') {
                    $order->update(['status' => 'cancel']);
                }

                // Ambil VA Number dan Bank dari respons Midtrans jika payment_type adalah bank_transfer
                if ($request->payment_type === 'bank_transfer' && isset($request->va_numbers[0])) {
                    $vaNumber = $request->va_numbers[0]['va_number'];
                    $bank = $request->va_numbers[0]['bank'];

                    // Update kolom payment_va_name dan payment_va_number di database
                    $order->update([
                        'payment_va_name' => $bank,
                        'payment_va_number' => $vaNumber,
                    ]);
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
}
