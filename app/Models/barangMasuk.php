<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk'; // jangan jamak kalau tabelmu `barang_masuk`
    protected $fillable = [
        'barang_id',
        'unit_barang_id',
        'tanggal_masuk',
        'divisi_id',
        'status'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function unitBarang()
    {
        return $this->belongsTo(UnitBarang::class, 'unit_barang_id');
    }
    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class);
    }

}


