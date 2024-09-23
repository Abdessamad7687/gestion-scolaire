<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professeur;
use App\Models\Groupe;
use App\Models\Comission;

class ProfesseurController extends Controller
{
    public function index()
    {
        // Retrouver tous les professeurs de la base de donnée
        //['groupes', 'comission']:les relation avc d autres tables,
        //Professeur::with(['groupes', 'comission']: ramene les donnees de la BD
        //Professeur:model
        // get : retourne un tableau
        $professeurs = Professeur::with(['groupes', 'comissions'])->get();
        return view('pages.professeurs.index', compact('professeurs'));
    }

    public function create()
    {
        $groupes = Groupe::all();
        $comissions = Comission::all();
       
        return view('pages.professeurs.create', compact('groupes', 'comissions'));
    }
    public function store(Request $request)
    {
        \Log::info($request->all());
        // Validate form data
        $validateddata = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'specialite' => 'required',
        ]);

        // Creé un nouveau Professeur
        Professeur::create([
            'nom' => $validateddata['nom'],
            'prenom' => $validateddata['prenom'],
            'specialite' => $validateddata['specialite'],
            'comissionfixe' => 100,
        ]);

        
        // Redirect or return a success message
        // succes est un alias du message
        return redirect()->route('professeurs.index')->with('success', 'Professeur est créé avec succès');
    }

    public function edit($id)
    {
        $professeur = Professeur::FindOrFail($id);
        return view('pages.professeurs.edit', compact('professeur'));
    }


    public function update(Request $request, $id)
    {
        $professeur = Professeur::FindOrFail($id);

        $validateddata = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'specialite' => 'required',
        ]);

        $professeur->nom = $request->nom;
        $professeur->prenom = $request->prenom;
        $professeur->specialite = $request->specialite;

        // Mettre a jour les informations du Professeur
        $professeur->update();
        return redirect()->route('professeurs.index')->with('success', 'Professeur est créé avec succès');
    }

    

  

    public function destroy($id)
    {
        $professeur = Professeur::FindOrFail($id);
     
        $professeur->comissions()->delete();
        $professeur->delete();

        return redirect()->route('professeurs.index')->with('success', 'Professeur supprimé avec succès');
    }

}
