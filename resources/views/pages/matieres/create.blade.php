@extends('layout.index')
@section('content')


    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('matieres.index') }}">Matieres</a></li>
            <li class="breadcrumb-item active" aria-current="page">Créer une matiere</li>
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
    <form class="container mt-4" method="POST" action="/">
        @csrf
        <!-- Student Information -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nom" class="form-label">nom_matiere</label>
                <input type="text" class="form-control" name="nom_matiere" id="nom_matiere" value="{{ old('nom') }}" placeholder="Entrez le nom_matiere"
                    required>
            </div>
        
        </div>

        <!--  -->
        <div class="row mb-3">

     
           
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

        <!-- Submit Button -->
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Créer Matiere</button>
            </div>
        </div>
    </form>



@endsection
