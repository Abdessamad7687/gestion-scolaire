@extends('layout.index')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('groupes.index') }}">Groupes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier un groupe</li>
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

    <form class="container mt-4" method="POST" action="{{ route('groupes.update', $groupe->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="max_etudiants" class="form-label">Nombre maximum d'étudiants</label>
                <input type="number" class="form-control" name="max_etudiants" id="max_etudiants" min="1" value="{{ old('max_etudiants', $groupe->max_etudiants) }}" required>
            </div>
            <div class="col-md-6">
                <label for="professeur_id" class="form-label">Professeur</label>
                <select class="form-select form-control" name="professeur_id" id="professeur_id" required>
                    <option value="" selected disabled>Sélectionnez un professeur</option>
                    @foreach ($professeurs as $professeur)
                        <option value="{{ $professeur->id }}" @selected(old('professeur_id', $groupe->professeur_id) == $professeur->id)>{{ $professeur->nom }} {{ $professeur->prenom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="filiere_id" class="form-label">Filière</label>
                <select class="form-select form-control" name="filiere_id" id="filiere_id" required>
                    <option value="" selected disabled>Sélectionnez une filière</option>
                    @foreach ($filieres as $filiere)
                        <option value="{{ $filiere->id }}" @selected(old('filiere_id', $groupe->filiere_id) == $filiere->id)>{{ $filiere->nom_filiere }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="niveau_id" class="form-label">Niveau</label>
                <select class="form-select form-control" name="niveau_id" id="niveau_id" required>
                    <option value="" selected disabled>Sélectionnez un niveau</option>
                    @foreach ($niveaux as $niveau)
                        <option value="{{ $niveau->id }}" @selected(old('niveau_id', $groupe->niveau_id) == $niveau->id)>{{ $niveau->nom_niveau }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="matiere_id" class="form-label">Matière</label>
                <select class="form-select form-control" name="matiere_id" id="matiere_id" required>
                    <option value="" selected disabled>Sélectionnez une matière</option>
                    @foreach ($matieres as $matiere)
                        <option value="{{ $matiere->id }}" @selected(old('matiere_id', $groupe->matiere_id) == $matiere->id)>{{ $matiere->nom_matiere }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Mettre à jour le groupe</button>
            </div>
        </div>
    </form>
@endsection


