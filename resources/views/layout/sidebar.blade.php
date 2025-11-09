<div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="{{ asset('assets/img/profile.jpg') }}" alt="Profil administrateur">
                    </div>
                    <div class="info">
                        <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                {{ auth()->user()->name ?? 'Admin' }}
                                <span class="user-level">Administrateur</span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                            <ul class="nav">
                                <li>
                                    <span class="link-collapse text-muted small d-block">Email : {{ auth()->user()->email ?? '—' }}</span>
                                </li>
                                <li>
                                    <span class="link-collapse text-muted small d-block">Ressources suivies : {{ collect($resourceCounts ?? [])->sum() }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">
                            <i class="la la-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('comissions.*') ? 'active' : '' }}">
                        <a href="{{ route('comissions.index') }}">
                            <i class="la la-table"></i>
                            <p>Comissions</p>
                            <span class="badge badge-count">{{ $resourceCounts['comissions'] ?? 0 }}</span>
                            @if (($pendingCommissions ?? 0) > 0)
                                <span class="badge badge-warning">{{ $pendingCommissions }} en attente</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('etudiants.index') ? 'active' : '' }}">
                        <a href="{{ route('etudiants.index') }}">
                            <i class="la la-keyboard-o"></i>
                            <p>Etudiants</p>
                            <span class="badge badge-count">{{ $resourceCounts['etudiants'] ?? 0 }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('professeurs.*') ? 'active' : '' }}">
                        <a href="{{ route('professeurs.index') }}">
                            <i class="la la-th"></i>
                            <p>Professeurs</p>
                            <span class="badge badge-count">{{ $resourceCounts['professeurs'] ?? 0 }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('groupes.*') ? 'active' : '' }}">
                        <a href="{{ route('groupes.index') }}">
                            <i class="la la-bell"></i>
                            <p>Groupes</p>
                            <span class="badge badge-success">{{ $resourceCounts['groupes'] ?? 0 }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('matieres.*') ? 'active' : '' }}">
                        <a href="{{ route('matieres.index') }}">
                            <i class="la la-font"></i>
                            <p>Matieres</p>
                            <span class="badge badge-danger">{{ $resourceCounts['matieres'] ?? 0 }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('niveaux.*') ? 'active' : '' }}">
                        <a href="{{ route('niveaux.index') }}">
                            <i class="la la-sitemap"></i>
                            <p>Niveaux</p>
                            <span class="badge badge-info">{{ $resourceCounts['niveaux'] ?? 0 }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('fillieres.*') ? 'active' : '' }}">
                        <a href="{{ route('fillieres.index') }}">
                            <i class="la la-fonticons"></i>
                            <p>Fillieres</p>
                            <span class="badge badge-primary">{{ $resourceCounts['fillieres'] ?? 0 }}</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>