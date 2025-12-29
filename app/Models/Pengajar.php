<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Pengajar extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama_pengajar',
        'email',
        'password',
        'no_hp',
        'alamat',
        'id_subject',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
{
    return $this->belongsTo(Subject::class);
}


    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_pengajar');
    }
}

