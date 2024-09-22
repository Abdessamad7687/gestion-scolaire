<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;
    protected $table = "niveaux";

    protected $fillable = [
        'nom_niveau',
    ];

    public function groupes()
    {
        return $this->hasMany(Groupe::class, 'niveau_id');
    }
}
