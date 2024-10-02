<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'id_user',
        'id_kategori',
        'nama_produk',
        'jumlah_produk',
        'harga_produk',
        'gambar_produk',
    ];

    // Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
