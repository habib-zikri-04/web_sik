<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiSantri extends Model
{
    protected $fillable = [
        'santri_id',
        'subject_id',
        'kelas_id',
        'nilai',
        'feedback',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function nilai()
{
    return $this->hasMany(NilaiSantri::class);
}

}

