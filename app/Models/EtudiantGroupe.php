<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtudiantGroupe extends Model
{
    use HasFactory;

    protected $table = "etudiant_groupes";
    protected $fillable = [
        'etudiant_id',
        'groupe_id',
    ];

}
