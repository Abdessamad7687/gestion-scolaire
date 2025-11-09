<?php

namespace App\Http\Controllers;

use App\Models\Comission;
use App\Models\Etudiant;
use App\Models\Professeur;
use Illuminate\Http\Request;

class ComissionController extends Controller
{
    public function index()
    {
        $comissions = Comission::with(['professeur', 'etudiant'])->get();

        return view('pages.comissions.index', compact('comissions'));
    }

    public function create()
    {
        $professeurs = Professeur::all();
        $etudiants = Etudiant::all();

        return view('pages.comissions.create', compact('professeurs', 'etudiants'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'montant' => 'required|numeric|min:0',
            'datecomission' => 'required|date',
            'statutcomission' => 'required|string|max:255',
            'professeur_id' => 'required|exists:professeurs,id',
            'etudiant_id' => 'required|exists:etudiants,id',
        ]);

        Comission::create($data);

        return redirect()->route('comissions.index')->with('success', 'Comission créée avec succès');
    }

    public function edit($id)
    {
        $comission = Comission::findOrFail($id);
        $professeurs = Professeur::all();
        $etudiants = Etudiant::all();

        return view('pages.comissions.edit', compact('comission', 'professeurs', 'etudiants'));
    }

    public function update(Request $request, $id)
    {
        $comission = Comission::findOrFail($id);

        $data = $request->validate([
            'montant' => 'required|numeric|min:0',
            'datecomission' => 'required|date',
            'statutcomission' => 'required|string|max:255',
            'professeur_id' => 'required|exists:professeurs,id',
            'etudiant_id' => 'required|exists:etudiants,id',
        ]);

        $comission->update($data);

        return redirect()->route('comissions.index')->with('success', 'Comission mise à jour avec succès');
    }

    public function destroy($id)
    {
        $comission = Comission::findOrFail($id);
        $comission->delete();

        return redirect()->route('comissions.index')->with('success', 'Comission supprimée avec succès');
    }
}
