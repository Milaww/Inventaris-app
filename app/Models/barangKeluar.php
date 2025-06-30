<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar'; // karena tidak pakai default "barang_keluars"

    protected $fillable = [
        'barang_id',
        'unit_barang_id',
        'tanggal_keluar',
        'divisi_id',
        'status'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function unitBarang()
    {
        return $this->belongsTo(UnitBarang::class);
    }
}
