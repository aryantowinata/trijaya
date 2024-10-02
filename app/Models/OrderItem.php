<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_orders',
        'id_produk',
        'jumlah',
        'harga_satuan',
    ];

    // Relasi ke tabel produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    // Relasi ke tabel order
    public function order()
    {
        return $this->belongsTo(Orders::class, 'id_orders');
    }
}
