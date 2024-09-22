<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;
    protected $table = "groupes";
    protected $fillable = [
        'max_etudiants',
        'professeur_id',
        'niveau_id',
        'filiere_id',
        'matiere_id',  
    ];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'professeur_id');
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class, 'niveau_id');
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'filiere_id');
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }

}
