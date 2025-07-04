<?php

namespace App\Models;

use App\Models\barang;
use App\Models\Lokasi;
use App\Models\Divisi; // Make sure this model exists at app/Models/Divisi.php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class unitBarang extends Model
{
    use HasFactory;

    protected $table = 'unit_barang'; // << Tambahkan ini!

    protected $fillable = [
        'barang_id',
        'kode_inventaris',
        'lokasi_id',
        'pic',
        'foto',
        'status'
    ];

    public function barang()
    {
        return $this->belongsTo(barang::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }

    public function barangMasuk()
    {
        return $this->hasOne(BarangMasuk::class, 'unit_barang_id');
    }

        public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class, 'unit_barang_id');
    }


    // public function barangMasuks()
    // {
    //     return $this->hasMany(barangMasuk::class);
    // }

}

