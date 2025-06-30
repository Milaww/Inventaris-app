<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('unit_barang', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('status'); // sesuaikan posisi kalau mau
            $table->string('pic')->nullable()->after('foto');   // Person in Control
        });
    }

    public function down(): void
    {
        Schema::table('unit_barang', function (Blueprint $table) {
            $table->dropColumn(['foto', 'pic']);
        });
    }
};
