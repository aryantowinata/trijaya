<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Cek apakah produk sudah ada di keranjang
        $cart = Cart::where('id_user', Auth::id())
            ->where('id_produk', $request->produk_id)
            ->first();

        if ($cart) {
            // Jika produk sudah ada, tambahkan jumlah
            $cart->jumlah += $request->jumlah;
            $cart->save();
        } else {
            // Jika produk belum ada, buat entry baru
            Cart::create([
                'id_user' => Auth::id(),
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function index()
    {
        $carts = Cart::with('produk')->where('id_user', Auth::id())->get();
        $orderCount = Cart::where('id_user', Auth::id())->count();
        return view('user.cart.index', compact('carts', 'orderCount'));
    }

    public function remove($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
