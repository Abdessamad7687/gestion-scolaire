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
                                            <i class="la la-money"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="numbers">
                                            <p class="card-category">Paiements</p>
                                            <h4 class="card-title">{{ $paiements }}</h4>
                                            <p class="card-category mb-0">
                                                Total : {{ number_format($paiementsMontant, 2, ',', ' ') }} MAD
                                            </p>
                                            <small>En attente : {{ $paiementsEnAttente }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Évolution des paiements ({{ now()->year }})</h4>
                                <p class="card-category">Montants encaissés par mois</p>
                            </div>
                            <div class="card-body">
                                <div id="chart-paiements-line" class="ct-chart ct-major-tenth" style="height: 300px;"></div>
                                <p id="chart-paiements-line-empty" class="text-muted m-0" style="display: none;">Aucune donnée de paiement disponible pour le moment.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Statut des commissions</h4>
                                <p class="card-category">Répartition actuelle</p>
                            </div>
                            <div class="card-body">
                                <div id="chart-commissions-pie" class="ct-chart ct-major-twelfth" style="height: 260px;"></div>
                                <p id="chart-commissions-pie-empty" class="text-muted m-0" style="display: none;">Aucune commission enregistrée.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Étudiants par filière</h4>
                                <p class="card-category">Nombre d'étudiants inscrits dans chaque filière</p>
                            </div>
                            <div class="card-body">
                                <div id="chart-etudiants-bar" class="ct-chart ct-major-tenth" style="height: 320px;"></div>
                                <p id="chart-etudiants-bar-empty" class="text-muted m-0" style="display: none;">Aucune donnée d'inscription par filière.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var paiementsLabels = @json($paiementsMonthlyLabels);
                var paiementsSeries = @json($paiementsMonthlySeries);
                var commissionsLabels = @json($comissionsStatusLabels);
                var commissionsSeries = @json($comissionsStatusSeries);
                var etudiantsLabels = @json($etudiantsParFiliereLabels);
                var etudiantsSeries = @json($etudiantsParFiliereSeries);

                var chartistPlugins = Chartist.plugins || {};
                var tooltipPlugin = chartistPlugins.tooltip ? chartistPlugins.tooltip() : null;

                var paiementsHasData = paiementsSeries.length > 0 && paiementsSeries.some(function (value) {
                    return Number(value) > 0;
                });

                if (paiementsHasData) {
                    new Chartist.Line('#chart-paiements-line', {
                        labels: paiementsLabels,
                        series: [paiementsSeries]
                    }, {
                        low: 0,
                        fullWidth: true,
                        showArea: true,
                        chartPadding: {
                            right: 20
                        },
                        plugins: tooltipPlugin ? [tooltipPlugin] : []
                    });
                } else {
                    document.getElementById('chart-paiements-line').style.display = 'none';
                    document.getElementById('chart-paiements-line-empty').style.display = 'block';
                }

                var commissionsHasData = commissionsSeries.length > 0 && commissionsSeries.some(function (value) {
                    return Number(value) > 0;
                });

                if (commissionsHasData) {
                    new Chartist.Pie('#chart-commissions-pie', {
                        labels: commissionsLabels,
                        series: commissionsSeries
                    }, {
                        donut: true,
                        donutWidth: 60,
                        showLabel: true,
                        plugins: tooltipPlugin ? [tooltipPlugin] : []
                    });
                } else {
                    document.getElementById('chart-commissions-pie').style.display = 'none';
                    document.getElementById('chart-commissions-pie-empty').style.display = 'block';
                }

                var etudiantsHasData = etudiantsSeries.length > 0 && etudiantsSeries.some(function (value) {
                    return Number(value) > 0;
                });

                if (etudiantsHasData) {
                    new Chartist.Bar('#chart-etudiants-bar', {
                        labels: etudiantsLabels,
                        series: [etudiantsSeries]
                    }, {
                        axisY: {
                            onlyInteger: true,
                            offset: 40
                        },
                        plugins: tooltipPlugin ? [tooltipPlugin] : [],
                        distributeSeries: false
                    });
                } else {
                    document.getElementById('chart-etudiants-bar').style.display = 'none';
                    document.getElementById('chart-etudiants-bar-empty').style.display = 'block';
                }
            });
        </script>
            
@endsection
