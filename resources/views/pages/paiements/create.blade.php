@extends('layout.index')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('paiements.index') }}">Paiements</a></li>
            <li class="breadcrumb-item active" aria-current="page">Enregistrer un paiement</li>
        </ol>
    </nav>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="container mt-4" method="POST" action="{{ route('paiements.store') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="etudiant_id" class="form-label">Étudiant</label>
                <select class="form-select form-control" name="etudiant_id" id="etudiant_id" required>
                    <option value="" selected disabled>Sélectionnez un étudiant</option>
                    @foreach ($etudiants as $etudiant)
                        <option value="{{ $etudiant->id }}" @selected(old('etudiant_id') == $etudiant->id)>
                            {{ $etudiant->nom }} {{ $etudiant->prenom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="montant" class="form-label">Montant (MAD)</label>
                <input type="number" step="0.01" min="0" class="form-control" name="montant" id="montant"
                    value="{{ old('montant') }}" required>
            </div>
            <div class="col-md-3">
                <label for="pourcentage" class="form-label">Pourcentage</label>
                <input type="number" step="0.01" min="0" max="100" class="form-control" name="pourcentage"
                    id="pourcentage" value="{{ old('pourcentage') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="datepaiement" class="form-label">Date de paiement</label>
                <input type="date" class="form-control" name="datepaiement" id="datepaiement"
                    value="{{ old('datepaiement') }}" required>
            </div>
            <div class="col-md-4">
                <label for="statutpaiement" class="form-label">Statut</label>
                <select class="form-select form-control" name="statutpaiement" id="statutpaiement" required>
                    <option value="" selected disabled>Sélectionnez un statut</option>
                    @foreach (['Payé', 'En attente', 'Annulé'] as $statut)
                        <option value="{{ $statut }}" @selected(old('statutpaiement') == $statut)>{{ $statut }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Enregistrer le paiement</button>
            </div>
        </div>
    </form>
@endsection


