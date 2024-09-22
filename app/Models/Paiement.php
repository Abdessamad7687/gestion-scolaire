<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $table = "paiements";
    protected $fillable = [
        'montant',
        'datepaiement',
        'statutpaiement',
        'pourcentage',
        'etudiant_id',
        
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }
}
