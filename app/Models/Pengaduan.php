<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Assuming User model is in the same namespace or needs to be imported
use App\Models\Santri; // Assuming Santri model is in the same namespace or needs to be imported
use Illuminate\Database\Eloquent\Factories\HasFactory; // Correct namespace for HasFactory

class Pengaduan extends Model
{
    /** @use HasFactory<\Database\Factories\PengaduanFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'santri_id',
        'judul',
        'deskripsi',
        'tanggal_kejadian',
        'status',
    ];

    protected $casts = [
        'tanggal_kejadian' => 'date',
    ];

    // Pelapor
    public function reporter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Santri Terlapor
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }
}
