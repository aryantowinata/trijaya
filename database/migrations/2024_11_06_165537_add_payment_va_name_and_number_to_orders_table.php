<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_va_name');  // Menggunakan 'string' untuk kolom teks
            $table->string('payment_va_number');  // Menggunakan 'string' untuk kolom teks
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_va_name', 'payment_va_number']);  // Menghapus kedua kolom
        });
    }
};
