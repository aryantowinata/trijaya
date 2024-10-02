<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome()
    {
        $kategories = Kategori::all();
        $produks = Produk::with('kategori')->get();

        return view('welcome', compact('produks', 'kategories'));
    }

    public function shop(Request $request)
    {
        $kategories = Kategori::all();
        $produks = Produk::with('kategori');

        // Cek apakah ada parameter sort
        if ($request->has('sort')) {
            if ($request->sort === 'price_asc') {
                $produks = $produks->orderBy('harga_produk', 'asc'); // Urutkan berdasarkan harga terendah
            } elseif ($request->sort === 'price_desc') {
                $produks = $produks->orderBy('harga_produk', 'desc'); // Urutkan berdasarkan harga tertinggi
            }
        }

        $produks = $produks->get(); // Ambil produk setelah diurutkan

        return view('shop', compact('produks', 'kategories'));
    }



    public function showByCategory($id)
    {
        $kategories = Kategori::all();
        $produks = Produk::with('kategori')->where('id_kategori', $id)->get(); // Ambil produk berdasarkan kategori


        return view('shop', compact('produks', 'kategories'));
    }

    public function cart()
    {
        $title = "Cart";
        return view('cart', compact('title'));
    }
    public function Abouts()
    {
        $title = "About";
        return view('abouts', compact('title'));
    }
}
