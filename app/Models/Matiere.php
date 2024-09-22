<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    protected $table = "matieres";
    protected $fillable = [
        'nom_matiere',
        
    ];

    public function groupes()
    {
        return $this->hasMany(Groupe::class, 'matiere_id');
    }
}
