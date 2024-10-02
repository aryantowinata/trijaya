<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_kategori')->constrained('kategori')->onDelete('cascade'); // Menambahkan kolom id_kategori
            $table->string('nama_produk');
            $table->integer('jumlah_produk');
            $table->decimal('harga_produk', 10, 2); // Harga dengan format decimal (10,2)
            $table->string('gambar_produk')->nullable(); // Kolom gambar bisa null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
