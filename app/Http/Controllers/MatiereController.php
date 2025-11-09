<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = Matiere::withCount('groupes')->get();

        return view('pages.matieres.index', compact('matieres'));
    }

    public function create()
    {
        return view('pages.matieres.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom_matiere' => 'required|string|max:255|unique:matieres,nom_matiere',
        ]);

        Matiere::create($data);

        return redirect()->route('matieres.index')->with('success', 'Matière créée avec succès');
    }

    public function edit($id)
    {
        $matiere = Matiere::findOrFail($id);

        return view('pages.matieres.edit', compact('matiere'));
    }

    public function update(Request $request, $id)
    {
        $matiere = Matiere::findOrFail($id);

        $data = $request->validate([
            'nom_matiere' => 'required|string|max:255|unique:matieres,nom_matiere,' . $matiere->id,
        ]);

        $matiere->update($data);

        return redirect()->route('matieres.index')->with('success', 'Matière mise à jour avec succès');
    }

    public function destroy($id)
    {
        $matiere = Matiere::findOrFail($id);
        $matiere->delete();

        return redirect()->route('matieres.index')->with('success', 'Matière supprimée avec succès');
    }
}
