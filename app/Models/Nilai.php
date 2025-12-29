<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'id_santri',
        'nilai_ujian',
        'nilai_tugas',
        'nilai_akhir'
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri');
    }
}

