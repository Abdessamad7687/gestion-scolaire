@extends('layout.index')
@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <h2 class="mb-3 mb-md-0">Étudiants</h2>
            <div class="d-flex gap-2 w-100 w-md-auto">
                <input id="etudiants-search" type="text" class="form-control" placeholder="Rechercher un étudiant...">
                <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
                    <i class="la la-plus mr-1"></i> Ajouter
                </a>
            </div>
        </div>

        <div class="row" id="etudiants-cards">
            @forelse($etudiants as $etudiant)
                @php
                    $groupes = $etudiant->groupes;
                    $filiereNames = $groupes->pluck('filiere.nom_filiere')->filter()->unique()->implode(' / ') ?: '—';
                    $niveauNames = $groupes->pluck('niveau.nom_niveau')->filter()->unique()->implode(' / ') ?: '—';
                    $matiereNames = $etudiant->matieres->pluck('nom_matiere')->implode(' / ') ?: '—';
                    $primaryPaiement = $etudiant->primaryPaiement;
                @endphp
                <div class="col-12 col-md-6 col-lg-4 mb-4 etudiant-card" data-name="{{ strtolower($etudiant->prenom . ' ' . $etudiant->nom) }}">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar rounded-circle text-white d-flex align-items-center justify-content-center mr-3"
                                    style="width: 48px; height: 48px; font-size: 1.25rem; background: linear-gradient(135deg, #1f6feb, #0b4a8b);">
                                    {{ strtoupper(substr($etudiant->prenom, 0, 1) . substr($etudiant->nom, 0, 1)) }}
                                </div>
                                <div>
                                    <h5 class="card-title mb-0">{{ $etudiant->prenom }} {{ $etudiant->nom }}</h5>
                                    <small class="text-muted">Né(e) le {{ \Carbon\Carbon::parse($etudiant->date_de_naissance)->format('d/m/Y') }}</small>
                                </div>
                            </div>

                            <div class="card-text flex-grow-1">
                                <p class="mb-2">
                                    <strong>Filière :</strong> {{ $filiereNames }}
                                </p>
                                <p class="mb-2">
                                    <strong>Niveau :</strong> {{ $niveauNames }}
                                </p>
                                <p class="mb-2">
                                    <strong>Groupes :</strong>
                                    @if ($groupes->isNotEmpty())
                                        {{ $groupes->map(fn ($groupe) => 'G' . $groupe->id)->implode(', ') }}
                                    @else
                                        —
                                    @endif
                                </p>
                                <p class="mb-3">
                                    <strong>Matières :</strong> {{ $matiereNames }}
                                </p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <small class="text-muted d-block">
                                            Paiement :
                                            @if ($primaryPaiement)
                                                {{ number_format($primaryPaiement->montant, 2, ',', ' ') }} MAD
                                                ({{ \Carbon\Carbon::parse($primaryPaiement->datepaiement)->format('d/m/Y') }})
                                            @else
                                                Aucun paiement
                                            @endif
                                        </small>
                                        <span class="badge badge-{{ match($primaryPaiement->statutpaiement ?? null) {
                                            'Payé' => 'success',
                                            'En attente' => 'warning',
                                            'Annulé' => 'danger',
                                            default => 'secondary',
                                        } }}">
                                            {{ $primaryPaiement->statutpaiement ?? 'Aucun' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 pt-3 border-top d-flex justify-content-between">
                                <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="la la-pencil mr-1"></i> Modifier
                                </a>
                                <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="la la-trash mr-1"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Aucun étudiant enregistré pour le moment.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var searchInput = document.getElementById('etudiants-search');
            var cards = document.querySelectorAll('.etudiant-card');

            searchInput.addEventListener('input', function () {
                var query = this.value.trim().toLowerCase();

                cards.forEach(function (card) {
                    var name = card.getAttribute('data-name');
                    card.style.display = name.includes(query) ? '' : 'none';
                });
            });
        });
    </script>
@endsection
