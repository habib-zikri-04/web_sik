<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'sesi',
        'subject_id',
        'pengajar_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
    ];

    public function subject()
{
    return $this->belongsTo(Subject::class);
}

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'jadwal_id');
    }

}
