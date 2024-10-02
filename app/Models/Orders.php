<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'total_harga',
        'status',
    ];

    // Relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke order items
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'id_orders');
    }
}
