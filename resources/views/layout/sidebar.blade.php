<div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="{{ asset('assets/img/profile.jpg') }}">
                    </div>
                    <div class="info">
                        <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                Admin
                                <span class="user-level">Administrator</span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                            <ul class="nav">
                                <li>
                                    <a href="#profile">
                                        <span class="link-collapse">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#edit">
                                        <span class="link-collapse">Edit Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#settings">
                                        <span class="link-collapse">Settings</span>
                                    </a>
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
                    <li class="nav-item {{ request()->is('components') ? 'active' : '' }}">
                        <a href="components.html">
                            <i class="la la-table"></i>
                            <p>Comissions</p>
                            <span class="badge badge-count">14</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('etudiants.index') ? 'active' : '' }}">
                        <a href="{{ route('etudiants.index') }}">
                            <i class="la la-keyboard-o"></i>
                            <p>Etudiants</p>
                            <!-- <span class="badge badge-count">50</span> -->
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('tables') ? 'active' : '' }}">
                        <a href="tables.html">
                            <i class="la la-th"></i>
                            <p>Professeurs</p>
                            <span class="badge badge-count">6</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('notifications') ? 'active' : '' }}">
                        <a href="notifications.html">
                            <i class="la la-bell"></i>
                            <p>Groupes</p>
                            <span class="badge badge-success">3</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('typography') ? 'active' : '' }}">
                        <a href="typography.html">
                            <i class="la la-font"></i>
                            <p>Matieres</p>
                            <span class="badge badge-danger">25</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('icons') ? 'active' : '' }}">
                        <a href="icons.html">
                            <i class="la la-fonticons"></i>
                            <p>Fillieres</p>
                        </a>
                    </li>
                </ul>

            </div>
        </div>