<?php

namespace App\Models;
use App\Models\unitBarang;
use App\Models\Divisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasis';

    protected $fillable = [
        'nama_lokasi',
    ];
        public function parent()
        {
            return $this->belongsTo(Lokasi::class, 'parent_id');
        }

        public function children()
        {
            return $this->hasMany(Lokasi::class, 'parent_id');
        }


        public function unitBarangs()
        {
            return $this->hasMany(unitBarang::class);
        }

        // public function divisis()
        // {
        //     return $this->hasMany(divisi::class);
        // }

}

