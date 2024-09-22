<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $table = "etudiants";

    protected $fillable = [
        'nom',
        'prenom',
        'date_de_naissance',
    ];

    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'etudiant_id');
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'etudiant_matiere');
    }

    public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'etudiant_groupes');
    }

    public function filiere()
    {
        return $this->hasManyThrough(Filiere::class, EtudiantGroupe::class, 'etudiant_id', 'id', 'id', 'filiere_id');
    }

    public function niveaux()
    {
        return $this->hasManyThrough(Niveau::class, EtudiantGroupe::class, 'etudiant_id', 'id', 'id', 'niveau_id');
    }
}
