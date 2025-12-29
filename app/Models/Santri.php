<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Santri extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'password',
        'no_hp',
        'alamat',
        'jenis_kelamin',
        'id_kelas',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function kelas()
    {
    return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'santri_id');
    }

    public function nilai()
{
    return $this->hasMany(NilaiSantri::class);
}


}
