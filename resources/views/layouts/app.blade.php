<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') :: CPanel iTV</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(auth()->user()->isRoleExist('abonents'))
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-user"></i> Clients
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->isRoleExist('iptv'))

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="nav_iptv" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-tv"></i> IPTV
                            </a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="nav_iptv">
                                <a class="dropdown-item" href="{{ route('web.iptv.channels.index') }}">Channels</a>
                                <a class="dropdown-item" href="{{ route('web.iptv.categories.index') }}">Categories</a>
                                <a class="dropdown-item" href="{{ route('web.iptv.epg.index') }}">Epg | Timeshift</a>
                            </div>
                        </li>

                        @endif

                        @if(auth()->user()->isRoleExist('content'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="nav_iptv" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-film"></i> Content
                            </a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="nav_iptv">
                                <a class="dropdown-item" href="{{ route('web.content.categories.main.index') }}">Categories</a>
                                <a class="dropdown-item" href="{{ route('web.content.genres.index') }}">Genres</a>
                                <a class="dropdown-item" href="{{ route('web.content.countries.index') }}">Countries</a>
                                <a class="dropdown-item" href="{{ route('web.content.people.index') }}">People</a>
                                <hr/>
                                <a class="dropdown-item" href="{{ route('web.content.concerts.main.index') }}">Concerts (LIVE)</a>
                            </div>
                        </li>
                        @endif

                        @if(auth()->user()->isRoleExist('reports'))
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-sort"></i> Statistics
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->isRoleExist('ads'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="nav_iptv" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-buysellads"></i> Ads
                            </a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="nav_iptv">
                                <a class="dropdown-item" href="{{ route('web.ads.carousel.index') }}">Carousel</a>
                                <a class="dropdown-item" href="{{ route('web.ads.partners.index') }}">Partners</a>
                            </div>
                        </li>
                        @endif

                        @if(auth()->user()->isRoleExist('payments'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="nav_iptv" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-shopping-cart"></i> Payments
                                </a>
                                <div class="dropdown-menu dropdown-primary" aria-labelledby="nav_iptv">
                                    <a class="dropdown-item" href="{{ route('web.payments.types.index') }}">Types</a>
                                    <a class="dropdown-item" href="{{ route('web.payments.tariffs.main.index') }}">Tariffs</a>
                                </div>
                            </li>
                        @endif

                        @if(auth()->user()->isRoleExist('admin'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="nav_iptv" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-link"></i> Network
                                </a>
                                <div class="dropdown-menu dropdown-primary" aria-labelledby="nav_iptv">
                                    <a class="dropdown-item" href="{{ route('web.network.ips.index') }}">Network</a>
                                    <a class="dropdown-item" href="{{ route('web.network.collections.main.index') }}">Collections</a>
                                    <a class="dropdown-item" href="{{ route('web.network.groups.main.index') }}">Groups</a>
                                </div>
                            </li>

                        @endif

                        @if(auth()->user()->isRoleExist('admin'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="nav_iptv" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cog"></i> Settings
                                </a>
                                <div class="dropdown-menu dropdown-primary" aria-labelledby="nav_iptv">
                                    <a class="dropdown-item" href="{{ route('web.content.mobiletv.index') }}">Mobile TV</a>
                                    <a class="dropdown-item" href="{{ route('web.content.home.index') }}">Home page | Mobile</a>
                                    <a class="dropdown-item" href="{{ route('web.abonents.profile.index') }}">Profile | User</a>
                                    <a class="dropdown-item" href="{{ route('web.content.modules.main.index') }}">Modules</a>
                                    <hr>
                                    <a class="dropdown-item" href="#">CPanel's users</a>
                                </div>
                            </li>

                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('web.auth.login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('web.auth.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('web.auth.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container-fluid">
            <div class="row">
                <div class="col-md-2 py-5">
                    @yield('menu')
                </div>
                <div class="col-md-10 p-5">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    <footer class="card-footer ">
        <div class="text-center">
            © 2016 - <?= date('Y') ?> <a href="http://itv.uz/">iTV</a><br/>
            Developed with <i class="fa fa-heart text-danger"></i> by <a href="https://github.com/davronbekov">Otabek Davronbekov</a> <br/>in 2019
        </div>
    </footer>
    <script src="{{ asset('bootstrap/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/mdb.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
