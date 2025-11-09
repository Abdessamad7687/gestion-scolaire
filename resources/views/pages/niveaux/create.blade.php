@extends('layout.index')
@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('niveaux.index') }}">Niveaux</a></li>
            <li class="breadcrumb-item active" aria-current="page">Créer un niveau</li>
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

    <form class="container mt-4" method="POST" action="{{ route('niveaux.store') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="nom_niveau" class="form-label">Nom du niveau</label>
                <input type="text" class="form-control" name="nom_niveau" id="nom_niveau" value="{{ old('nom_niveau') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Créer le niveau</button>
            </div>
        </div>
    </form>
@endsection


