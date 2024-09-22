@extends('layout.index')

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('etudiants.index') }}">Etudiants</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier un étudiant</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="col-md-12">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-dark text-white">
                    <h3 class="text-center">Modifier Étudiant {{ $etudiant->nom }}</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('etudiants.update', $etudiant->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="container">
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="nom" class="form-label text-primary">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $etudiant->nom) }}" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom', $etudiant->prenom) }}" required>
                        </div>
                        </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label for="date_de_naissance" class="form-label">Date de Naissance</label>
                                    <input type="date" class="form-control" id="date_de_naissance" name="date_de_naissance" value="{{ old('date_de_naissance', $etudiant->date_de_naissance) }}" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-4">
                                    <label for="groupe_id" class="form-label">Groupe</label>
                                    <select id="groupe_id" name="groupe_id" class="form-select form-control" required>
                                        @foreach($groupes as $groupe)
                                            <option value="{{ $groupe->id }}" {{ $etudiant->groupes->contains($groupe) ? 'selected' : '' }}>
                                                {{ $groupe->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-4">
                                    <label for="filiere" class="form-label">Filière</label>
                                    <select id="filiere" name="filiere" class="form-select form-control" required>
                                        @foreach($filieres as $filiere)
                                            <option value="{{ $filiere->nom_filiere }}" {{ $etudiant->groupes->first()->filiere->nom_filiere === $filiere->nom_filiere ? 'selected' : '' }}>
                                                {{ $filiere->nom_filiere }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        

                        <div class="form-group mb-4">
                            <label for="niveau" class="form-label">Niveau</label>
                            <select id="niveau" name="niveau" class="form-select form-control" required>
                                @foreach($niveaux as $niveau)
                                    <option value="{{ $niveau->nom_niveau }}" {{ $etudiant->groupes->first()->niveau->nom_niveau === $niveau->nom_niveau ? 'selected' : '' }}>
                                        {{ $niveau->nom_niveau }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="matieres" class="form-label">Matieres</label>
                            <select id="matieres" name="matieres[]" class="form-select form-control form-control" multiple>
                                @foreach($matieres as $matiere)
                                    <option value="{{ $matiere->nom_matiere }}" {{ $etudiant->matieres->contains($matiere) ? 'selected' : '' }}>
                                        {{ $matiere->nom_matiere }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="statutpaiement" class="form-label">Statut Paiement</label>
                            
                            <select class="form-select form-control" name="statutpaiement" id="status" required>
                            @if($etudiant->paiements->isNotEmpty())
                                <!-- Retrieve the first payment status -->
                                @php
                                    $currentStatus = $etudiant->paiements->first()->statutpaiement;
                                @endphp

                                <!-- Option for 'Payé' -->
                                <option value="Payé" {{ $currentStatus == 'Payé' ? 'selected' : '' }}>Payé</option>
                                
                                <!-- Option for 'Non payé' -->
                                <option value="Non payé" {{ $currentStatus == 'Non payé' ? 'selected' : '' }}>Non payé</option>
                                
                            @else
                                <option value="" selected disabled>Sélectionnez un statut</option>
                                <option value="Payé">Payé</option>
                                <option value="Non payé">Non payé</option>
                            @endif
                        </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="date_paiement" class="form-label">Date Paiement</label>
                            <input type="date" class="form-control" id="date_paiement" name="date_paiement" value="{{ old('date_paiement', $etudiant->paiements->first()->datepaiement ?? '') }}">
                        </div>

                        <div class="form-group mb-4">
                            <label for="prix" class="form-label">Prix</label>
                            <input type="number" class="form-control" id="prix" name="prix" value="{{ old('prix', $etudiant->paiements->first()->montant ?? '') }}">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-lg w-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy2" viewBox="0 0 16 16">
                            <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v3.5A1.5 1.5 0 0 1 11.5 6h-7A1.5 1.5 0 0 1 3 4.5V1H1.5a.5.5 0 0 0-.5.5m9.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z"/>
                            </svg>    
                            Modifier</button>
                        </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('etudiants.index') }}" class="btn btn-link">Retour à la liste des étudiants</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
