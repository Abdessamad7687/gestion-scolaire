<?php

namespace App\Providers;

use App\Models\Comission;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Groupe;
use App\Models\Matiere;
use App\Models\Professeur;
use App\Models\Niveau;
use App\Models\Paiement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layout.sidebar', 'layout.navbar'], function ($view): void {
            $resourceCounts = [
                'comissions' => Comission::count(),
                'etudiants' => Etudiant::count(),
                'professeurs' => Professeur::count(),
                'groupes' => Groupe::count(),
                'matieres' => Matiere::count(),
                'fillieres' => Filiere::count(),
                'niveaux' => Niveau::count(),
                'paiements' => Paiement::count(),
            ];

            $pendingCommissions = Comission::where('statutcomission', '!=', 'Payée')->count();
            $pendingPaiements = Paiement::where('statutpaiement', 'En attente')->count();

            $latestCommissions = Comission::with(['professeur:id,nom', 'etudiant:id,nom',])
                ->latest('datecomission')
                ->limit(5)
                ->get()
                ->map(function (Comission $commission): array {
                    $date = $commission->datecomission
                        ? Carbon::parse($commission->datecomission)->format('d/m/Y')
                        : null;

                    return [
                        'id' => $commission->id,
                        'montant' => $commission->montant,
                        'statut' => $commission->statutcomission,
                        'date' => $date,
                        'professeur' => $commission->professeur?->nom,
                        'etudiant' => $commission->etudiant?->nom,
                    ];
                });

            $recentEtudiants = Etudiant::latest('created_at')
                ->limit(5)
                ->get(['id', 'nom', 'prenom', 'created_at'])
                ->map(function (Etudiant $etudiant): array {
                    return [
                        'id' => $etudiant->id,
                        'nom' => trim("{$etudiant->prenom} {$etudiant->nom}") ?: $etudiant->nom,
                        'created_at' => $etudiant->created_at
                            ? $etudiant->created_at->diffForHumans()
                            : null,
                    ];
                });

            $latestPaiements = Paiement::with('etudiant:id,nom,prenom')
                ->latest('datepaiement')
                ->limit(5)
                ->get()
                ->map(function (Paiement $paiement): array {
                    return [
                        'id' => $paiement->id,
                        'etudiant' => trim("{$paiement->etudiant?->prenom} {$paiement->etudiant?->nom}") ?: $paiement->etudiant?->nom,
                        'montant' => $paiement->montant,
                        'statut' => $paiement->statutpaiement,
                        'date' => $paiement->datepaiement
                            ? Carbon::parse($paiement->datepaiement)->format('d/m/Y')
                            : null,
                    ];
                });

            $routeName = optional(request()->route())->getName();

            $pageNotifications = [
                'dashboard' => [
                    'title' => 'Tableau de bord',
                    'message' => "Synthèse générale : {$resourceCounts['etudiants']} étudiant(s), {$resourceCounts['professeurs']} professeur(s), {$pendingCommissions} commission(s) et {$pendingPaiements} paiement(s) en attente.",
                    'type' => 'info',
                ],
                'etudiants.index' => [
                    'title' => 'Gestion des étudiants',
                    'message' => "Vous gérez actuellement {$resourceCounts['etudiants']} étudiant(s) inscrits.",
                    'type' => 'info',
                ],
                'groupes.index' => [
                    'title' => 'Gestion des groupes',
                    'message' => "{$resourceCounts['groupes']} groupe(s) actifs, pensez à vérifier les niveaux associés.",
                    'type' => 'success',
                ],
                'matieres.index' => [
                    'title' => 'Gestion des matières',
                    'message' => "{$resourceCounts['matieres']} matière(s) référencée(s) dans la plateforme.",
                    'type' => 'info',
                ],
                'fillieres.index' => [
                    'title' => 'Gestion des filières',
                    'message' => "{$resourceCounts['fillieres']} filière(s) disponibles pour les inscriptions.",
                    'type' => 'info',
                ],
                'professeurs.index' => [
                    'title' => 'Gestion des professeurs',
                    'message' => "{$resourceCounts['professeurs']} professeur(s) enregistrés, affectez-les aux groupes si nécessaire.",
                    'type' => 'info',
                ],
                'comissions.index' => [
                    'title' => 'Suivi des commissions',
                    'message' => "{$pendingCommissions} commission(s) à traiter. Ne laissez pas les paiements en suspens.",
                    'type' => $pendingCommissions > 0 ? 'warning' : 'success',
                ],
                'paiements.index' => [
                    'title' => 'Gestion des paiements',
                    'message' => "{$resourceCounts['paiements']} paiement(s) enregistrés dont {$pendingPaiements} en attente.",
                    'type' => $pendingPaiements > 0 ? 'warning' : 'success',
                ],
                'niveaux.index' => [
                    'title' => 'Gestion des niveaux',
                    'message' => "{$resourceCounts['niveaux']} niveau(x) défini(s) pour organiser les groupes.",
                    'type' => 'info',
                ],
            ];

            $pageNotification = $pageNotifications[$routeName] ?? null;

            $view->with([
                'resourceCounts' => $resourceCounts,
                'pendingCommissions' => $pendingCommissions,
                'latestCommissions' => $latestCommissions,
                'recentEtudiants' => $recentEtudiants,
                'latestPaiements' => $latestPaiements,
                'pendingPaiements' => $pendingPaiements,
                'pageNotification' => $pageNotification,
            ]);
        });
    }
}
