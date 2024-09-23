<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groupe;
use App\Models\Matiere;

class MatiereController extends Controller
{
    public function index()
    {
        // Retrouver tous les professeurs de la base de donnée
        //['groupes', 'comission']:les relation avc d autres tables,
        //Professeur::with(['groupes', 'comission']: ramene les donnees de la BD
        //Professeur:model
        // get : retourne un tableau
        $matieres = Matiere::with(['groupes'])->get();
        return view('pages.matieres.index', compact('matieres'));
    }

    public function create()
    {
        $groupes = Groupe::all();
        $matieres = Matiere::all();
        // nom du model est Matiere
       
        return view('pages.matieres.create', compact('matieres', 'groupes'));
    }

    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'nom_matiere' => 'required|string|max:255',
            'Groupe' => 'required|string|max:255',
            
        ]);

        // Creé un nouveau etudiant
        $matiere = Matiere::create([
            'nom_matiere' => $validatedData['nom'],
            
        ]);

        // associer l'étudiant avec le groupe
        $matiere->groupes()->attach($validatedData['groupe_id']);

        
       

        // Redirect or return a success message
        // succes est un alias du message
        return redirect()->route('matieres.index')->with('success', 'Matiere créé avec succès');
    }

    public function edit($id)
    {
        $matiere = Matiere::findOrFail($id);

        return view('pages.matieres.edit', compact('matiere'));
    }

    

    public function update(Request $request, $id)
    {
        // Find the student (etudiant) by ID
        $matieres = Matiere::findOrFail($id);

        // Validate the incoming form data
        $validatedData = $request->validate([
            'nom_matiere' => 'required|string|max:255',
            'groupe' => 'required|string|max:255',
        ]);

        $matiere->update([
            'nom_matiere' => $validatedData['nom_matiere'],
            'groupe' => $validatedData['groupe'],
            
        ]);

        $etudiant->groupes()->sync([$validatedData['groupe_id']]);

        $filiere = Filiere::where('nom_filiere', $validatedData['filiere'])->first();
        $niveau = Niveau::where('nom_niveau', $validatedData['niveau'])->first();

        if ($filiere && $niveau) {
            $groupe = Groupe::findOrFail($validatedData['groupe_id']);
            $groupe->update([
                'filiere_id' => $filiere->id,
                'niveau_id' => $niveau->id,
            ]);
        }

        if (!empty($validatedData['matieres'])) {
            $matiereIds = Matiere::whereIn('nom_matiere', $validatedData['matieres'])->pluck('id');
            $etudiant->matieres()->sync($matiereIds);
        } else {
            $etudiant->matieres()->detach();
        }
        if ($validatedData['statutpaiement'] && isset($validatedData['prix'])) {
            $paiement = $etudiant->paiements()->first();
            if ($paiement) {
                $paiement->update([
                    'montant' => $validatedData['prix'],
                    'datepaiement' => $validatedData['date_paiement'],
                    'statutpaiement' => $validatedData['statutpaiement'],
                    'pourcentage' => 100,
                ]);
            } else {
                Paiement::create([
                    'montant' => $validatedData['prix'],
                    'datepaiement' => $validatedData['date_paiement'],
                    'statutpaiement' => $validatedData['statutpaiement'],
                    'pourcentage' => 100,
                    'etudiant_id' => $etudiant->id,
                ]);
            }
        }

        return redirect()->route('etudiants.index')->with('success', 'Etudiant mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $etudiant = Etudiant::findOrFail($id); // retrouver l'étudiant par id
        $etudiant->groupes()->detach();
        $etudiant->matieres()->detach();
        $etudiant->paiements()->delete();
        $etudiant->delete();

        return redirect()->route('etudiants.index')->with('success', 'Etudiant supprimé avec succès');
    }
}
