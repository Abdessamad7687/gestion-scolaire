@extends('layout.index')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('matieres.index') }}">Matières</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier une matière</li>
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

    <form class="container mt-4" method="POST" action="{{ route('matieres.update', $matiere->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="nom_matiere" class="form-label">Nom de la matière</label>
                <input type="text" class="form-control" name="nom_matiere" id="nom_matiere" value="{{ old('nom_matiere', $matiere->nom_matiere) }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Mettre à jour la matière</button>
            </div>
        </div>
    </form>
@endsection


