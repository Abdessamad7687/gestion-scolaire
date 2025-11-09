<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Groupe;
use App\Models\Matiere;
use App\Models\Niveau;
use App\Models\Professeur;
use Illuminate\Http\Request;

class GroupeController extends Controller
{
    public function index()
    {
        $groupes = Groupe::with(['filiere', 'niveau', 'professeur', 'matiere'])->get();

        return view('pages.groupes.index', compact('groupes'));
    }

    public function create()
    {
        $filieres = Filiere::all();
        $niveaux = Niveau::all();
        $professeurs = Professeur::all();
        $matieres = Matiere::all();

        return view('pages.groupes.create', compact('filieres', 'niveaux', 'professeurs', 'matieres'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'max_etudiants' => 'required|integer|min:1',
            'professeur_id' => 'required|exists:professeurs,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'filiere_id' => 'required|exists:filieres,id',
            'matiere_id' => 'required|exists:matieres,id',
        ]);

        Groupe::create($data);

        return redirect()->route('groupes.index')->with('success', 'Groupe créé avec succès');
    }

    public function edit($id)
    {
        $groupe = Groupe::findOrFail($id);
        $filieres = Filiere::all();
        $niveaux = Niveau::all();
        $professeurs = Professeur::all();
        $matieres = Matiere::all();

        return view('pages.groupes.edit', compact('groupe', 'filieres', 'niveaux', 'professeurs', 'matieres'));
    }

    public function update(Request $request, $id)
    {
        $groupe = Groupe::findOrFail($id);

        $data = $request->validate([
            'max_etudiants' => 'required|integer|min:1',
            'professeur_id' => 'required|exists:professeurs,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'filiere_id' => 'required|exists:filieres,id',
            'matiere_id' => 'required|exists:matieres,id',
        ]);

        $groupe->update($data);

        return redirect()->route('groupes.index')->with('success', 'Groupe mis à jour avec succès');
    }

    public function destroy($id)
    {
        $groupe = Groupe::findOrFail($id);
        $groupe->delete();

        return redirect()->route('groupes.index')->with('success', 'Groupe supprimé avec succès');
    }
}
