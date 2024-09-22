<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function index()
    {
        $filieres = Filiere::with('groupes')->get();
        return view('pages.fillieres.index', compact('filieres'));
    }

    public function create()
    {
        return view('pages.fillieres.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'nom_filiere' => 'required|string',
        ]);
        Filiere::create([
            'nom_filiere' => $data['nom_filiere'],
        ]);
        return redirect()->route('fillieres.index')->with('success', 'Fillière ajouté avec succès');
    }

    public function edit($id)
    {
        $filliere = Filiere::findOrFail($id);
        return view('pages.fillieres.edit', compact('filliere'));
    }

    public function update(Request $request, $id)
    {

        $filliere = Filiere::findOrFail($id);
        $data = $request->validate([
            'nom_filiere' => 'required|string',
        ]);
        $filliere->nom_filiere = $data['nom_filiere'];
        $filliere->update();
        return redirect()->route('fillieres.index')->with('success', 'Fillière modifié avec succès');
    }

    public function destroy($id)
    {
        $filliere = Filiere::findOrFail($id);
        $filliere->delete();
        return redirect()->route('fillieres.index')->with('success', 'Fillière supprimé');
    }
}
