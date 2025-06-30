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
    Schema::create('lokasis', function (Blueprint $table) {
        $table->id();
        $table->string('nama_lokasi');
        $table->unsignedBigInteger('parent_id')->nullable();  // kolom parent_id, boleh null
        $table->timestamps();

        // foreign key ke id di tabel yang sama
        $table->foreign('parent_id')->references('id')->on('lokasis')->onDelete('cascade');
    });
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
    Schema::dropIfExists('lokasis');
}
};

