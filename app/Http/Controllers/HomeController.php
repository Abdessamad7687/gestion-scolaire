<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Comission;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Groupe;
use App\Models\Matiere;
use App\Models\Niveau;
use App\Models\Paiement;

class HomeController extends Controller
{
    public function dashboard()
    {
        $etudiants = Etudiant::count();
        $filieres = Filiere::count();
        $groupes = Groupe::count();
        $matieres = Matiere::count();
        $niveaux = Niveau::count();
        $paiements = Paiement::count();
        $paiementsMontant = Paiement::sum('montant');
        $paiementsEnAttente = Paiement::where('statutpaiement', 'En attente')->count();

        $currentYear = now()->year;

        $driver = DB::connection()->getDriverName();
        $monthExpression = $driver === 'sqlite'
            ? 'strftime("%Y-%m", datepaiement)'
            : 'DATE_FORMAT(datepaiement, "%Y-%m")';

        $paiementsMonthly = Paiement::whereYear('datepaiement', $currentYear)
            ->selectRaw("{$monthExpression} as period, SUM(montant) as total")
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        $paiementsMonthlyLabels = $paiementsMonthly->map(function ($row) {
            return Carbon::createFromFormat('Y-m', $row->period)->format('M');
        })->values();
        $paiementsMonthlySeries = $paiementsMonthly->map(function ($row) {
            return round($row->total, 2);
        })->values();

        $comissionsStatus = Comission::select('statutcomission', DB::raw('COUNT(*) as total'))
            ->groupBy('statutcomission')
            ->get();

        $comissionsStatusLabels = $comissionsStatus->pluck('statutcomission')->values();
        $comissionsStatusSeries = $comissionsStatus->pluck('total')->values();

        $etudiantsParFiliereQuery = DB::table('etudiant_groupes')
            ->join('groupes', 'etudiant_groupes.groupe_id', '=', 'groupes.id')
            ->join('filieres', 'groupes.filiere_id', '=', 'filieres.id')
            ->select('filieres.nom_filiere as filiere', DB::raw('COUNT(DISTINCT etudiant_groupes.etudiant_id) as total'))
            ->groupBy('filieres.nom_filiere')
            ->orderBy('total', 'desc')
            ->get();

        $etudiantsParFiliereLabels = $etudiantsParFiliereQuery->pluck('filiere')->values();
        $etudiantsParFiliereSeries = $etudiantsParFiliereQuery->pluck('total')->values();

        return view('pages.dashboard', compact(
            'etudiants',
            'filieres',
            'groupes',
            'matieres',
            'niveaux',
            'paiements',
            'paiementsMontant',
            'paiementsEnAttente',
            'paiementsMonthlyLabels',
            'paiementsMonthlySeries',
            'comissionsStatusLabels',
            'comissionsStatusSeries',
            'etudiantsParFiliereLabels',
            'etudiantsParFiliereSeries'
        ));
    }
}
