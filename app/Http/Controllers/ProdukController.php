<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProdukController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua produk
        $kategories = Kategori::all();
        $produks = Produk::with('kategori')->get();

        return view('produk', compact('produks', 'kategories'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mengambil semua kategori untuk form
        $kategories = Kategori::all();

        return view('produk.create', compact('kategories'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_produk' => 'required|string', // Menyimpan kategori dalam bentuk string
            'harga_produk' => 'required|numeric',
            'jumlah_produk' => 'required|integer',
            'gambar_produk' => 'image|nullable|max:2048', // Max ukuran 2MB
        ]);

        // Mendapatkan ID kategori berdasarkan nama kategori yang dipilih
        $kategori = Kategori::where('nama_kategori', $validatedData['kategori_produk'])->first();
        if ($kategori) {
            $validatedData['id_kategori'] = $kategori->id; // Menambahkan ID kategori ke validasi data
        } else {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
        }

        // Handle file upload jika ada gambar produk
        if ($request->hasFile('gambar_produk')) {
            $fileName = time() . '.' . $request->gambar_produk->extension();
            $request->gambar_produk->storeAs('produk', $fileName, 'public');
            $validatedData['gambar_produk'] = $fileName;
        }

        // Tambah user_id untuk tracking
        $validatedData['id_user'] = auth()->id();

        // Simpan produk ke database
        Produk::create($validatedData);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }


    /**
     * Show the form for editing the specified product.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        // Mengambil semua kategori untuk form edit
        $kategories = Kategori::all();

        return view('produk.edit', compact('produk', 'kategories'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_produk' => 'required|string',
            'jumlah_produk' => 'required|integer',
            'harga_produk' => 'required|numeric',
            'gambar_produk' => 'image|nullable|max:2048',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar_produk')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar_produk) {
                Storage::disk('public')->delete('produk/' . $produk->gambar_produk);
            }

            // Simpan gambar baru
            $fileName = time() . '.' . $request->gambar_produk->extension();
            $request->gambar_produk->storeAs('produk', $fileName, 'public');
            $validatedData['gambar_produk'] = $fileName;
        } else {
            // Jika tidak ada gambar baru, tetap gunakan gambar lama
            $validatedData['gambar_produk'] = $produk->gambar_produk;
        }

        // Update produk di database
        $produk->update($validatedData);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
