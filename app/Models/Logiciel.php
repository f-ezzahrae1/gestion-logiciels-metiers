<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logiciel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_logiciel';
    protected $fillable = [
        'nom',
        'version',
        'description',
        'date_installation',
    ];

    protected $casts = [
        'date_installation' => 'date',
    ];
}
