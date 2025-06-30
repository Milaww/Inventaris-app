<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $fillable = [
        'nama_brg',
        'kategori_id',
    ];
    
    public function unitBarangs()
    {
        return $this->hasMany(unitBarang::class);
    }

    public function kategori()
    {
    return $this->belongsTo(kategori::class);
    }

    public function barangMasuks()
    {
        return $this->belongsTo(barangMasuk::class);
    }

    // public function lokasi()
    // {
    //     return $this->belongsTo(Lokasi::class);
    // }
}
