<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Groupe;
use App\Models\Matiere;
use App\Models\Niveau;
use App\Models\Paiement;

class HomeController extends Controller
{
    public function dashboard() {
        $etudiants = Etudiant::count();
        $filieres = Filiere::count();
        $groupes = Groupe::count();
        $matieres = Matiere::count();
        $niveaux = Niveau::count();
        $paiements = Paiement::count();
        return view('pages.dashboard', compact('etudiants', 'filieres', 'groupes', 'matieres', 'niveaux', 'paiements'));
    }
}
