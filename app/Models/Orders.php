<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpseclib3\Crypt\Blowfish;

class Orders extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi oleh mass-assignment
    protected $fillable = [
        'id_user',
        'total_harga',
        'status',
        'payment_va_name',
        'payment_va_number',
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

    // Menyimpan kunci enkripsi dari file .env
    protected $encryptionKey;

    // Konstruktor untuk inisialisasi kunci enkripsi
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        // Mengambil kunci enkripsi dari file .env, jika tidak ada, pakai 'default_kunci'
        $this->encryptionKey = env('BLOWFISH_ENCRYPTION_KEY');
    }

    // Mengatur data 'payment_va_name' sebelum disimpan (enkripsi)
    public function setPaymentVaNameAttribute($value)
    {
        // Enkripsi data payment_va_name dengan metode Blowfish sebelum disimpan ke database
        $this->attributes['payment_va_name'] = $this->encryptData($value);
    }

    // Mengambil data 'payment_va_name' setelah diambil dari database (dekripsi)
    public function getPaymentVaNameAttribute($value)
    {
        // Dekripsi data payment_va_name setelah diambil dari database
        return $this->decryptData($value);
    }

    // Mengatur data 'payment_va_number' sebelum disimpan (enkripsi)
    public function setPaymentVaNumberAttribute($value)
    {
        // Enkripsi data payment_va_number dengan metode Blowfish sebelum disimpan ke database
        $this->attributes['payment_va_number'] = $this->encryptData($value);
    }

    // Mengambil data 'payment_va_number' setelah diambil dari database (dekripsi)
    public function getPaymentVaNumberAttribute($value)
    {
        // Dekripsi data payment_va_number setelah diambil dari database
        return $this->decryptData($value);
    }

    // Fungsi untuk mengenkripsi data sebelum disimpan ke database
    private function encryptData($data)
    {
        // Membuat objek Blowfish dengan mode CBC
        $blowfish = new Blowfish('cbc');
        $blowfish->setKey($this->encryptionKey); // Set kunci enkripsi

        // Membuat nilai IV (initialization vector) acak untuk keamanan tambahan
        $iv = random_bytes($blowfish->getBlockLength() >> 3);
        $blowfish->setIV($iv); // Set IV untuk Blowfish

        // Mengenkripsi nilai data dan menggabungkannya dengan IV
        return base64_encode($iv . $blowfish->encrypt($data)); // Kembalikan dalam format base64 agar mudah disimpan
    }

    // Fungsi untuk mendekripsi data yang sudah dienkripsi
    private function decryptData($encryptedData)
    {
        // Membuat objek Blowfish dengan mode CBC
        $blowfish = new Blowfish('cbc');
        $blowfish->setKey($this->encryptionKey); // Set kunci enkripsi

        // Mendekode data yang dienkripsi dari format base64
        $data = base64_decode($encryptedData);

        // Mengambil IV (initialization vector) dari data terenkripsi
        $iv = substr($data, 0, $blowfish->getBlockLength() >> 3);

        // Mengambil ciphertext setelah IV
        $ciphertext = substr($data, $blowfish->getBlockLength() >> 3);

        // Set IV untuk Blowfish
        $blowfish->setIV($iv);

        // Mendekripsi ciphertext dan mengembalikan nilai asli dari data
        return $blowfish->decrypt($ciphertext);
    }
}
