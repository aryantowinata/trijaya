<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'gambar_kategori' => 'image|nullable|max:2048', // Max ukuran 2MB
        ]);

        // Handle file upload jika ada gambar kategori
        if ($request->hasFile('gambar_kategori')) {
            $fileName = time() . '.' . $request->gambar_kategori->extension();
            $request->gambar_kategori->storeAs('kategori', $fileName, 'public');
            $validatedData['gambar_kategori'] = $fileName;
        }

        // Simpan kategori ke database
        Kategori::create($validatedData);

        return redirect()->route('produk.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
}
