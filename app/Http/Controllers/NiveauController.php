<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    public function index()
    {
        $niveaux = Niveau::withCount('groupes')->get();

        return view('pages.niveaux.index', compact('niveaux'));
    }

    public function create()
    {
        return view('pages.niveaux.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom_niveau' => 'required|string|max:255|unique:niveaux,nom_niveau',
        ]);

        Niveau::create($data);

        return redirect()->route('niveaux.index')->with('success', 'Niveau créé avec succès.');
    }

    public function edit($id)
    {
        $niveau = Niveau::findOrFail($id);

        return view('pages.niveaux.edit', compact('niveau'));
    }

    public function update(Request $request, $id)
    {
        $niveau = Niveau::findOrFail($id);

        $data = $request->validate([
            'nom_niveau' => 'required|string|max:255|unique:niveaux,nom_niveau,' . $niveau->id,
        ]);

        $niveau->update($data);

        return redirect()->route('niveaux.index')->with('success', 'Niveau mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $niveau = Niveau::findOrFail($id);
        $niveau->delete();

        return redirect()->route('niveaux.index')->with('success', 'Niveau supprimé avec succès.');
    }
}
