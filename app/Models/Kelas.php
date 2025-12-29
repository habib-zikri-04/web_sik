<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'nama_kelas',
        'angkatan',
    ];

    protected $table = 'kelas';

    public function santris()
    {
        return $this->hasMany(Santri::class, 'kelas_id');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'kelas_id');
    }

}
