<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;
    protected $table = "professeurs";
    protected $fillable = [
        'nom',
        'prenom',
        'specialite',
        'comissionfixe',
    ];

    public function comissions()
    {
        return $this->hasMany(Comission::class, 'professeur_id');
    }

    public function groupes()
    {
        return $this->hasMany(Groupe::class, 'professeur_id');
    }

}
