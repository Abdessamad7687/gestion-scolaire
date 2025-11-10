@extends('layout.index')
@section('content')
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
            <h2 class="mb-3 mb-md-0">Professeurs</h2>
            <div class="d-flex gap-2 w-100 w-md-auto">
                <input id="professeurs-search" type="text" class="form-control" placeholder="Rechercher un professeur...">
                <a href="{{ route('professeurs.create') }}" class="btn btn-primary">
                    <i class="la la-plus mr-1"></i> Ajouter un professeur
                </a>
            </div>
        </div>

        <div class="row" id="professeurs-cards">
            @forelse ($professeurs as $professeur)
                <div class="col-12 col-md-6 col-lg-4 mb-4 professeur-card" data-name="{{ strtolower($professeur->prenom . ' ' . $professeur->nom) }}">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar rounded-circle text-white d-flex align-items-center justify-content-center mr-3"
                                    style="width: 48px; height: 48px; font-size: 1.25rem; background: linear-gradient(135deg, #f39c12, #d35400);">
                                    {{ strtoupper(substr($professeur->prenom, 0, 1) . substr($professeur->nom, 0, 1)) }}
                                </div>
                                <div>
                                    <h5 class="card-title mb-0">{{ $professeur->prenom }} {{ $professeur->nom }}</h5>
                                    <small class="text-muted">Spécialité : {{ $professeur->specialite ?? '—' }}</small>
                                </div>
                            </div>

                            <div class="card-text flex-grow-1">
                                <p class="mb-2">
                                    <strong>Commission fixe :</strong>
                                    {{ number_format($professeur->comissionfixe, 2, ',', ' ') }} MAD
                                </p>
                                <p class="mb-2">
                                    <strong>Groupes encadrés :</strong> {{ $professeur->groupes_count }}
                                </p>
                                <p class="mb-2">
                                    <strong>Commissions enregistrées :</strong> {{ $professeur->comissions_count }}
                                </p>
                            </div>

                            <div class="mt-3 pt-3 border-top d-flex justify-content-between">
                                <a href="{{ route('professeurs.edit', $professeur->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="la la-pencil mr-1"></i> Modifier
                                </a>
                                <form action="{{ route('professeurs.destroy', $professeur->id) }}" method="POST"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce professeur ?');">
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
                    <div class="alert alert-info">Aucun professeur enregistré pour le moment.</div>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var searchInput = document.getElementById('professeurs-search');
            var cards = document.querySelectorAll('.professeur-card');

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

