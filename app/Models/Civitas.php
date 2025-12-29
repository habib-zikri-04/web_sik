<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Civitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'password',
        'no_hp',
        'alamat',
    ];


}

