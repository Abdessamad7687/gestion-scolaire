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
                        <h3 class="text-center">Modifier Matiere {{ $matiere->nom_matiere }}</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('matieres.update', $matiere->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="nom" class="form-label text-primary">nom_matiere</label>
                                            <input type="text" class="form-control" id="nom_matiere" name="nom_matiere"
                                                value="{{ old('nom_matiere', $matiere->nom_matiere) }}" required>
                                        </div>
                                    </div>


                                </div>
                            </div>
                          
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-dark btn-lg w-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-floppy2" viewBox="0 0 16 16">
                                            <path
                                                d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v3.5A1.5 1.5 0 0 1 11.5 6h-7A1.5 1.5 0 0 1 3 4.5V1H1.5a.5.5 0 0 0-.5.5m9.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z" />
                                        </svg>
                                        Modifier</button>
                                </div>
                            
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('etudiants.index') }}" class="btn btn-link">Retour à la liste des matieres</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
