<?php

namespace App\Models;
use App\Models\unitBarang;
use App\Models\lokasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisis';

    protected $fillable = [
        'nama_divisi',
        'lokasi_id',
    ];

    // Relasi ke Lokasi (setiap divisi milik satu lokasi)
    public function lokasi()
    {
        return $this->belongsTo(lokasi::class, 'lokasi_id');
    }


    // (Opsional) Kalau unit_barang juga relasi ke divisi
    public function unitBarangs()
    {
        return $this->hasMany(unitBarang::class);
    }
}
