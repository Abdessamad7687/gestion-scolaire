<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Groupe;
use App\Models\Matiere;
use App\Models\Niveau;
use App\Models\Paiement;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{

    public function index()
    {
        // Retrouver tous les etudiants de la base de donnée
        $etudiants = Etudiant::with(['groupes', 'matieres', 'paiements'])->get();
        return view('pages.etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        $groupes = Groupe::all();
        $filieres = Filiere::all();
        $niveaux = Niveau::all();
        $matieres = Matiere::all();
        return view('pages.etudiants.create', compact('groupes', 'filieres', 'niveaux', 'matieres'));
    }

    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_de_naissance' => 'required|date',
            'groupe_id' => 'required|exists:groupes,id',
            'filiere' => 'required|string',
            'niveau' => 'required|string',
            'matieres' => 'array',
            'statutpaiement' => 'required|string',
            'date_paiement' => 'nullable|date',
            'prix' => 'nullable|numeric',
        ]);

        // Create new student (etudiant)
        $etudiant = Etudiant::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'date_de_naissance' => $validatedData['date_de_naissance'],
        ]);

        // Associate the etudiant with a groupe
        $etudiant->groupes()->attach($validatedData['groupe_id']);

        // Handle filiere and niveau if necessary
        $filiere = Filiere::where('nom_filiere', $validatedData['filiere'])->first();
        $niveau = Niveau::where('nom_niveau', $validatedData['niveau'])->first();

        // Handle matieres (many-to-many relationship)
        if (!empty($validatedData['matieres'])) {
            $matiereIds = Matiere::whereIn('nom_matiere', $validatedData['matieres'])->pluck('id');
            $etudiant->matieres()->sync($matiereIds);
        }

        // Handle Paiement (if provided)
        if (!empty($validatedData['prix']) && !empty($validatedData['date_paiement'])) {
            Paiement::create([
                'montant' => $validatedData['prix'],
                'datepaiement' => $validatedData['date_paiement'],
                'pourcentage' => 100,
                'statutpaiement' => $validatedData['statutpaiement'],
                'etudiant_id' => $etudiant->id,
            ]);
        }

        // Redirect or return a success message
        return redirect()->route('etudiants.index')->with('success', 'Etudiant créé avec succès');
    }

    public function edit($id)
    {
        $etudiant = Etudiant::with(['groupes.filiere', 'groupes.niveau', 'matieres'])->findOrFail($id);
        $groupes = Groupe::all();
        $filieres = Filiere::all();
        $niveaux = Niveau::all();
        $matieres = Matiere::all();

        return view('pages.etudiants.edit', compact('etudiant', 'groupes', 'filieres', 'niveaux', 'matieres'));
    }

   

    public function update(Request $request, $id)
    {
        // Find the student (etudiant) by ID
        $etudiant = Etudiant::findOrFail($id);

        // Validate the incoming form data
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_de_naissance' => 'required|date',
            'groupe_id' => 'required|exists:groupes,id',
            'filiere' => 'required|string',
            'niveau' => 'required|string',
            'matieres' => 'array',
            'statutpaiement' => 'required|string',
            'date_paiement' => 'nullable|date',
            'prix' => 'nullable|numeric',
        ]);

        $etudiant->update([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'date_de_naissance' => $validatedData['date_de_naissance'],
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
    $etudiant = Etudiant::findOrFail($id);
    $etudiant->groupes()->detach();
    $etudiant->matieres()->detach();
    $etudiant->paiements()->delete();
    $etudiant->delete();

    return redirect()->route('etudiants.index')->with('success', 'Etudiant supprimé avec succès');
}


}
