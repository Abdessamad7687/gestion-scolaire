    <div class="main-header">
            <div class="logo-header">
                <a href="{{ route('dashboard') }}" class="logo">
                    Gestion Scolaire
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">

                    <form class="navbar-left navbar-form nav-search mr-md-3" action="">
                        <div class="input-group">
                            <input type="text" placeholder="Search ..." class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-search search-icon"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarStudentsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-user-plus"></i>
                                @if (!empty($recentEtudiants) && count($recentEtudiants) > 0)
                                    <span class="notification">{{ count($recentEtudiants) }}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu notif-box" aria-labelledby="navbarStudentsDropdown">
                                <li>
                                    <div class="dropdown-title">
                                        @if (!empty($recentEtudiants) && count($recentEtudiants) > 0)
                                            {{ count($recentEtudiants) }} nouvel(le)s étudiant(e)s inscrit(e)s
                                        @else
                                            Aucune inscription récente
                                        @endif
                                    </div>
                                </li>
                                <li>
                                    <div class="notif-center">
                                        @forelse(($recentEtudiants ?? collect()) as $etudiant)
                                            <a href="{{ route('etudiants.edit', $etudiant['id']) }}">
                                                <div class="notif-icon notif-info">
                                                    <i class="la la-user"></i>
                                                </div>
                                                <div class="notif-content">
                                                    <span class="block">
                                                        {{ $etudiant['nom'] ?? 'Étudiant' }}
                                                    </span>
                                                    @if (!empty($etudiant['created_at']))
                                                        <span class="time">{{ $etudiant['created_at'] }}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        @empty
                                            <span class="small text-muted d-block px-3 py-2">Les dernières inscriptions apparaîtront ici.</span>
                                        @endforelse
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="{{ route('etudiants.index') }}"> <strong>Voir tous les étudiants</strong> <i class="la la-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarNotifDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-bell"></i>
                                <span class="notification">{{ $pendingCommissions ?? 0 }}</span>
                            </a>
                            <ul class="dropdown-menu notif-box" aria-labelledby="navbarNotifDropdown">
                                <li>
                                    <div class="dropdown-title">
                                        {{ ($pendingCommissions ?? 0) > 0 ? "{$pendingCommissions} commission(s) à suivre" : 'Aucune notification en attente' }}
                                    </div>
                                </li>
                                <li>
                                    <div class="notif-center">
                                        @forelse(($latestCommissions ?? collect()) as $commission)
                                            <a href="{{ route('comissions.edit', $commission['id']) }}">
                                                <div class="notif-icon {{ ($commission['statut'] ?? '') === 'Payée' ? 'notif-success' : 'notif-danger' }}">
                                                    <i class="la la-money"></i>
                                                </div>
                                                <div class="notif-content">
                                                    <span class="block">
                                                        {{ number_format($commission['montant'] ?? 0, 2, ',', ' ') }} MAD
                                                    </span>
                                                    <span class="block small text-muted">
                                                        @if (!empty($commission['etudiant']))
                                                            {{ $commission['etudiant'] }}
                                                        @endif
                                                        @if (!empty($commission['professeur']))
                                                            • {{ $commission['professeur'] }}
                                                        @endif
                                                    </span>
                                                    @if (!empty($commission['date']))
                                                        <span class="time">{{ $commission['date'] }}</span>
                                                    @endif
                                                    <span class="badge badge-{{ ($commission['statut'] ?? '') === 'Payée' ? 'success' : 'warning' }}">
                                                        {{ $commission['statut'] ?? 'En attente' }}
                                                    </span>
                                                </div>
                                            </a>
                                        @empty
                                            <span class="small text-muted d-block px-3 py-2">Les dernières commissions apparaîtront ici.</span>
                                        @endforelse
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="{{ route('comissions.index') }}"> <strong>Voir les commissions</strong> <i class="la la-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false"> <img src="{{ asset('assets/img/profile.jpg') }}" alt="user-img"
                                    width="36" class="img-circle"><span>{{ auth()->user()->name ?? 'Admin' }}</span></span> </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <div class="user-box">
                                        <div class="u-img"><img src="{{ asset('assets/img/profile.jpg') }}" alt="user"></div>
                                        <div class="u-text">
                                            <h4>{{ auth()->user()->name ?? 'Admin' }}</h4>
                                            <p class="text-muted mb-2">{{ auth()->user()->email ?? '' }}</p>
                                            <div class="d-flex flex-column text-start">
                                                @foreach(($resourceCounts ?? []) as $key => $value)
                                                    <span class="small text-muted">{{ ucfirst($key) }} : <strong>{{ $value }}</strong></span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fa fa-power-off"></i> Déconnexion</button>
                                </form>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                    </ul>
                </div>
            </nav>
        </div>