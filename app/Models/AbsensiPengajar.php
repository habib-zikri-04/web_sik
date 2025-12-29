<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiPengajar extends Model
{
    protected $table = 'absensi_pengajars';

    protected $fillable = [
        'pengajar_id',
        'jadwal_id',
        'status',
        'waktu_absen',
    ];

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
