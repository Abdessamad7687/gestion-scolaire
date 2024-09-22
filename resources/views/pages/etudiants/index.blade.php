@extends('layout.index')
@section('content')
    <div class="container">
        <div class="row col-md-12 d-flex justify-content-between">
            <div class="col-md-6">
                <h2>Table des Etudiants</h2>
            </div>

            <div class="col-md-6">
                <a href="{{ route('etudiants.create') }}" class="btn btn-primary d-flex float-right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                    </svg>
                    Ajouter
                </a>
            </div>
        </div>
    </div>

    <div style="overflow-x: auto; max-width: 100%;">
        @if (session('success'))
            
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table id="example" class="table table-striped" style="width:100%;">
            <thead>
                <tr>
                    <th style="white-space: nowrap;">Nom</th>
                    <th style="white-space: nowrap;">Prenom</th>
                    <th style="white-space: nowrap;">Date de naissance</th>
                    <th style="white-space: nowrap;">Groupe</th>
                    <th style="white-space: nowrap;">Filiere</th>
                    <th style="white-space: nowrap;">Niveau</th>
                    <th style="white-space: nowrap;">Matieres</th>
                    <th style="white-space: nowrap;">Date de paiement</th>
                    <th style="white-space: nowrap;">Prix</th>
                    <th style="white-space: nowrap;">Status</th>
                    <th style="white-space: nowrap;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($etudiants as $etudiant)
                <tr>
                    <td>{{ $etudiant->nom }}</td>
                    <td>{{ $etudiant->prenom }}</td>
                    <td>{{ $etudiant->date_de_naissance }}</td>

                    <!-- Display Groupes -->
                    <td>
                        @foreach($etudiant->groupes as $groupe)
                            {{ $groupe->id }}<br>
                        @endforeach
                    </td>

                    <!-- Display Filiere -->
                    <td>
                    @foreach($etudiant->groupes as $groupe)
                        {{ $groupe->filiere->nom_filiere }}<br>
                    @endforeach
                    </td>

                    <!-- Display Niveau -->
                    <td>
                    @foreach($etudiant->groupes as $groupe)
                        {{ $groupe->niveau->nom_niveau }}<br>
                    @endforeach
                    </td>

                    <!-- Display Matieres -->
                    <td>
                        @if($etudiant->matieres->isNotEmpty())
                            {{ implode(' / ', $etudiant->matieres->pluck('nom_matiere')->toArray()) }}
                        @else
                            Aucune Matière
                        @endif
                    </td>

                    <!-- Display Paiements -->
                    <td>
                        @if($etudiant->paiements->isNotEmpty())
                            @foreach($etudiant->paiements as $paiement)
                                {{ $paiement->datepaiement }}<br>
              
                            @endforeach
                        @else
                            Aucun Paiement
                        @endif
                    </td>
                    <td>
                    @foreach($etudiant->paiements as $paiement)
        
                        {{ $paiement->montant }}
                               
                            @endforeach
                    </td>

                    <td>
                    @foreach($etudiant->paiements as $paiement)
                          
                        {{ $paiement->statutpaiement }}
                            @endforeach
                    </td>

                    <td>
                         <div class="row">
                             <div class="d-flex gap-3">
                                <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning btn-sm p-2 m-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                    </svg>
                                    Modifier
                                </a>
                                <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm p-2 m-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
        </svg>
        Supprimer
    </button>
</form>
                             </div>
                         </div>
                     </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <style>
        /* General styling for thead */
thead {
    background-color: lightblue;
    color: #ffffff; 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 14px; 
    text-transform: uppercase; 
}


thead tr {
    border-bottom: 2px solid #444;
}


thead th {
    padding: 12px 8px; 
    text-align: center; 
    border-right: 1px solid #333; 
    white-space: nowrap; 
}


thead th:last-child {
    border-right: none;
}


thead th:hover {
    background-color: skyblue;
    cursor: pointer; 
}
/* General styling for tbody */
tbody {
    background-color: #2c2c2e; /* Dark background for body */
    color: #f0f0f0; /* Light text color */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Custom font */
    font-size: 14px; /* Font size */
}

/* Styling for each table row */
tbody tr {
    border-bottom: 1px solid #444; /* Border between rows */
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

/* Alternating row colors */
tbody tr:nth-child(odd) {
    background-color: #1c1c1e; /* Darker background for odd rows */
}

tbody tr:nth-child(even) {
    background-color: #252527; /* Slightly lighter background for even rows */
}

/* Styling for each cell */
tbody td {
    padding: 12px 8px; /* Padding for cells */
    text-align: center; /* Center text */
    border-right: 1px solid #333; /* Border between cells */
    vertical-align: middle; /* Center content vertically */
    white-space: nowrap; /* Prevent text wrapping */
}

/* Remove last border on the last cell of each row */
tbody td:last-child {
    border-right: none;
}

/* Hover effect for table rows */
tbody tr:hover {
    background-color: #3a3a3c; /* Slightly lighter background on hover */
    cursor: pointer; /* Change cursor to pointer */
}

/* Styling for 'Actions' cell buttons */
tbody td .btn {
    font-size: 12px; /* Smaller font for buttons */
    padding: 5px 10px; /* Padding for buttons */
    border-radius: 5px; /* Rounded corners */
}

/* Custom button styling */
tbody td .btn-warning {
    background-color: #f0ad4e; /* Orange background */
    border-color: #eea236; /* Orange border */
    color: #fff; /* White text */
    transition: background-color 0.3s ease; /* Smooth transition for hover */
}

tbody td .btn-warning:hover {
    background-color: #ec971f; /* Darker orange on hover */
    border-color: #d58512; /* Darker border on hover */
}

tbody td .btn-danger {
    background-color: #d9534f; /* Red background */
    border-color: #d43f3a; /* Red border */
    color: #fff; /* White text */
    transition: background-color 0.3s ease; /* Smooth transition for hover */
}

tbody td .btn-danger:hover {
    background-color: #c9302c; /* Darker red on hover */
    border-color: #ac2925; /* Darker border on hover */
}

/* Icons within buttons */
tbody td .btn svg {
    margin-right: 5px; /* Space between icon and text */
    vertical-align: middle; /* Align icon with text */
}

    </style>
    <!-- Include necessary scripts for DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>

    <script>
        new DataTable('#example');
    </script>
@endsection
