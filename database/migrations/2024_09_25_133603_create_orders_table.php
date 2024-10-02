<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // ID unik untuk order
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->decimal('total_harga', 10, 2)->nullable(); // Total harga semua item
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending'); // Status order
            $table->timestamps(); // Waktu pembuatan order dan update
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
