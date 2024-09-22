@extends('layout.index')
@section('content')


    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fillieres.index') }}">Fillières</a></li>
            <li class="breadcrumb-item active" aria-current="page">Créer une fillière</li>
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
    <form class="container mt-4" method="POST" action="{{ route('fillieres.store') }}">
        @csrf
        <!-- Student Information -->
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="nom" class="form-label">Nom de la fillière</label>
                <input type="text" class="form-control" name="nom_filiere" id="nom_filiere" value="{{ old('nom_filiere') }}" placeholder="Entrez le nom">
            </div>
        </div>

        
        <!-- Submit Button -->
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Créer la fillière</button>
            </div>
        </div>
    </form>



@endsection
