<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    protected $table = 'licences';
    protected $primaryKey = 'id_licence';

    protected $fillable = [
        'id_utilisateur',
        'id_logiciel',      
        'cle_licence',
        'date_acquisition',
        'status',
        'type_licence',
        'contrat',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur', 'id_utilisateur');
    }

    public function logiciel()
    {
        return $this->belongsTo(Logiciel::class, 'id_logiciel', 'id_logiciel');
    }
}
