<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'nama',
        'kode',
        'pengajar_id',
    ];

    protected $table = 'kelas';

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class);
    }

    public function santris()
    {
        return $this->hasMany(Santri::class, 'kelas_id');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'kelas_id');
    }
}

