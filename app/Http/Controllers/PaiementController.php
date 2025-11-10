<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('etudiant:id,nom,prenom')
            ->latest('datepaiement')
            ->get()
            ->map(function (Paiement $paiement): array {
                return [
                    'id' => $paiement->id,
                    'montant' => $paiement->montant,
                    'pourcentage' => $paiement->pourcentage,
                    'statut' => $paiement->statutpaiement,
                    'date' => Carbon::parse($paiement->datepaiement)->format('d/m/Y'),
                    'etudiant' => trim("{$paiement->etudiant?->prenom} {$paiement->etudiant?->nom}") ?: $paiement->etudiant?->nom,
                ];
            });

        return view('pages.paiements.index', compact('paiements'));
    }

    public function create()
    {
        $etudiants = Etudiant::orderBy('nom')->orderBy('prenom')->get(['id', 'nom', 'prenom']);

        return view('pages.paiements.create', compact('etudiants'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'montant' => ['required', 'numeric', 'min:0'],
            'pourcentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'datepaiement' => ['required', 'date'],
            'statutpaiement' => ['required', 'in:Payé,En attente,Annulé'],
            'etudiant_id' => ['required', 'exists:etudiants,id'],
        ]);

        Paiement::create($data);

        return redirect()->route('paiements.index')->with('success', 'Paiement enregistré avec succès.');
    }

    public function edit($id)
    {
        $paiement = Paiement::findOrFail($id);
        $etudiants = Etudiant::orderBy('nom')->orderBy('prenom')->get(['id', 'nom', 'prenom']);

        return view('pages.paiements.edit', compact('paiement', 'etudiants'));
    }

    public function update(Request $request, $id)
    {
        $paiement = Paiement::findOrFail($id);

        $data = $request->validate([
            'montant' => ['required', 'numeric', 'min:0'],
            'pourcentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'datepaiement' => ['required', 'date'],
            'statutpaiement' => ['required', 'in:Payé,En attente,Annulé'],
            'etudiant_id' => ['required', 'exists:etudiants,id'],
        ]);

        $paiement->update($data);

        return redirect()->route('paiements.index')->with('success', 'Paiement mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return redirect()->route('paiements.index')->with('success', 'Paiement supprimé avec succès.');
    }
}
