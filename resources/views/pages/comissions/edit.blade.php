@extends('layout.index')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('comissions.index') }}">Comissions</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier une comission</li>
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

    <form class="container mt-4" method="POST" action="{{ route('comissions.update', $comission->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="professeur_id" class="form-label">Professeur</label>
                <select class="form-select form-control" name="professeur_id" id="professeur_id" required>
                    <option value="" selected disabled>Sélectionnez un professeur</option>
                    @foreach ($professeurs as $professeur)
                        <option value="{{ $professeur->id }}" @selected(old('professeur_id', $comission->professeur_id) == $professeur->id)>{{ $professeur->nom }} {{ $professeur->prenom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="etudiant_id" class="form-label">Étudiant</label>
                <select class="form-select form-control" name="etudiant_id" id="etudiant_id" required>
                    <option value="" selected disabled>Sélectionnez un étudiant</option>
                    @foreach ($etudiants as $etudiant)
                        <option value="{{ $etudiant->id }}" @selected(old('etudiant_id', $comission->etudiant_id) == $etudiant->id)>{{ $etudiant->nom }} {{ $etudiant->prenom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="montant" class="form-label">Montant</label>
                <input type="number" step="0.01" min="0" class="form-control" name="montant" id="montant" value="{{ old('montant', $comission->montant) }}" required>
            </div>
            <div class="col-md-4">
                <label for="datecomission" class="form-label">Date</label>
                <input type="date" class="form-control" name="datecomission" id="datecomission" value="{{ old('datecomission', $comission->datecomission) }}" required>
            </div>
            <div class="col-md-4">
                <label for="statutcomission" class="form-label">Statut</label>
                <select class="form-select form-control" name="statutcomission" id="statutcomission" required>
                    <option value="" selected disabled>Sélectionnez un statut</option>
                    @foreach (['Payée', 'En attente', 'Annulée'] as $statut)
                        <option value="{{ $statut }}" @selected(old('statutcomission', $comission->statutcomission) == $statut)>{{ $statut }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Mettre à jour la comission</button>
            </div>
        </div>
    </form>
@endsection


