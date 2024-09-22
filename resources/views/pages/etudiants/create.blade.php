@extends('layout.index')
@section('content')


    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('etudiants.index') }}">Etudiants</a></li>
            <li class="breadcrumb-item active" aria-current="page">Créer un étudiant</li>
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
    <form class="container mt-4" method="POST" action="{{ route('etudiants.store') }}">
        @csrf
        <!-- Student Information -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" id="nom" value="{{ old('nom') }}" placeholder="Entrez le nom"
                    required>
            </div>
            <div class="col-md-6">
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Entrez le prenom"
                    required>
            </div>
        </div>

        <!-- Date de naissance and Groupe -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="date-naissance" class="form-label">Date de naissance</label>
                <input type="date" class="form-control" name="date_de_naissance" id="date-naissance" required>
            </div>
            <div class="col-md-6">
                <label for="groupe" class="form-label">Groupe</label>
                <select class="form-select form-control form-control" name="groupe_id" id="groupe" required>
                    <option value="" selected disabled>Sélectionnez un groupe</option>
                    @foreach ($groupes as $groupe)
                        <option value="{{ $groupe->id }}">{{ $groupe->id }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Filiere and Niveau -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="filiere" class="form-label">Filiere</label>
                <select class="form-select form-control" name="filiere" id="filiere" required>
                    <option value="" selected disabled>Sélectionnez une filière</option>
                    @foreach ($filieres as $filiere)
                        <option value="{{ $filiere->nom_filiere }}">{{ $filiere->nom_filiere }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="niveau" class="form-label">Niveau</label>
                <select class="form-select form-control" name="niveau" id="niveau" required>
                    <option value="" selected disabled>Sélectionnez un niveau</option>
                    @foreach ($niveaux as $niveau)
                        <option value="{{ $niveau->nom_niveau }}">{{ $niveau->nom_niveau }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Matieres and Status -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="matieres" class="form-label">Matieres</label>
                <select class="form-select form-control" name="matieres[]" id="matieres" multiple>
                    @foreach ($matieres as $matiere)
                        <option value="{{ $matiere->nom_matiere }}">{{ $matiere->nom_matiere }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select class="form-select form-control" name="statutpaiement" id="status" required>
                    <option value="" selected disabled>Sélectionnez un status</option>
                    <option value="Payé">Payé</option>
                    <option value="Non payé">Non payé</option>
                </select>
            </div>
        </div>

        <!-- Date de paiement and Prix -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="date-paiement" class="form-label">Date de paiement</label>
                <input type="date" class="form-control" name="date_paiement" id="date-paiement">
            </div>
            <div class="col-md-6">
                <label for="prix" class="form-label">Prix</label>
                <input type="text" class="form-control" name="prix" id="prix" placeholder="Entrez le prix">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Créer l'étudiant</button>
            </div>
        </div>
    </form>



@endsection
