<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comission extends Model
{
    use HasFactory;

    protected $table = "comissions";
    protected $fillable = [
        'montant',
        'datecomission',
        'statutcomission',
        'professeur_id',
        'etudiant_id',
        
    ];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'professeur_id');
    }
    
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }

}
