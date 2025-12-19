<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_utilisateur';
    protected $keyType = 'int';
    public $incrementing = true; // AUTO_INCREMENT
    public $timestamps = false; // إلا كان عندك created_at و updated_at

    public function licences()
    {
        return $this->hasMany(Licence::class, 'id_utilisateur', 'id_utilisateur');
    }

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'role',
    ];

// Laravel utilise Password par défaut
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
}
