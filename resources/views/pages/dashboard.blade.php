@extends('layout.index')
@section('content')
    
            <div class="container-fluid">
                <h4 class="page-title">Dashboard</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-stats card-warning">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="la la-users"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="numbers">
                                            <p class="card-category">Etudiants</p>
                                            <h4 class="card-title">{{ $etudiants }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-stats card-success">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="la la-bar-chart"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="numbers">
                                            <p class="card-category">Fillières</p>
                                            <h4 class="card-title">{{ $filieres  }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-stats card-danger">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="la la-newspaper-o"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="numbers">
                                            <p class="card-category">Groupes</p>
                                            <h4 class="card-title">{{ $groupes }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-stats card-primary">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="la la-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="numbers">
                                            <p class="card-category">Matières</p>
                                            <h4 class="card-title">{{ $matieres }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-stats card-warning">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="la la-users"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="numbers">
                                            <p class="card-category">Niveaux</p>
                                            <h4 class="card-title">{{ $niveaux }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-stats card-warning">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="la la-users"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="numbers">
                                            <p class="card-category">Paiements</p>
                                            <h4 class="card-title">{{ $paiements }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
            
@endsection
