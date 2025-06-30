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
            Schema::create('unit_barang', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('barang_id');
                $table->string('kode_inventaris');
                $table->unsignedBigInteger('lokasi_id');
                $table->string('divisi');
                $table->string('status');
                $table->timestamp('created_at')->useCurrent();

                // Optional: foreign key constraints jika ada tabel barang dan lokasi
                $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
                $table->foreign('lokasi_id')->references('id')->on('lokasis')->onDelete('cascade');
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('unit_barang');
        }

};
