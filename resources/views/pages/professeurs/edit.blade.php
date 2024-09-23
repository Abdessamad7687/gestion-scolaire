@extends('layout.index')
@section('content')


    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('professeurs.index') }}">Professeurs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier le professeur</li>
        </ol>
    </nav>


    @if ($errors->any())
        <div class="alert alert-danger">
            <h4>create page of prof</h2>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form class="container mt-4" method="POST" action="{{ route('professeurs.update', $professeur->id) }}">
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" id="nom" value="{{ $professeur->nom }}" placeholder="Entrez le nom" required>
        </div>
        <div class="col-md-6">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom" value="{{ $professeur->prenom }}" id="prenom" placeholder="Entrez le prénom" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="specialite" class="form-label">Spécialité</label>
            <input type="text" class="form-control" name="specialite" id="specialite" value="{{ $professeur->specialite }}" placeholder="Entrez la spécialité" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </div>
</form>




@endsection
