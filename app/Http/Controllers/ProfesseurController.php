<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
    public function index()
    {
        $professeurs = Professeur::withCount(['groupes', 'comissions'])->get();

        return view('pages.professeurs.index', compact('professeurs'));
    }

    public function create()
    {
        return view('pages.professeurs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
            'comissionfixe' => 'required|numeric|min:0',
        ]);

        Professeur::create($data);

        return redirect()->route('professeurs.index')->with('success', 'Professeur créé avec succès');
    }

    public function edit($id)
    {
        $professeur = Professeur::findOrFail($id);

        return view('pages.professeurs.edit', compact('professeur'));
    }

    public function update(Request $request, $id)
    {
        $professeur = Professeur::findOrFail($id);

        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'specialite' => 'required|string|max:255',
            'comissionfixe' => 'required|numeric|min:0',
        ]);

        $professeur->update($data);

        return redirect()->route('professeurs.index')->with('success', 'Professeur mis à jour avec succès');
    }

    public function destroy($id)
    {
        $professeur = Professeur::findOrFail($id);
        $professeur->delete();

        return redirect()->route('professeurs.index')->with('success', 'Professeur supprimé avec succès');
    }
}
