<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('niania-logo.avif')}}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <img src="{{ asset('images/niania-logo.avif') }}" width="45" alt="" class="d-inline-block align-middle mr-2">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto w-auto">
                        <li class="nav-item mx-2">
                            <form class="form-inline">
                                <input type="search" class="form-control mr-1" >
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">{{__("Wyszukaj")}}</button>
                            </form>
                        </li>
                        <!-- Authentication Links -->

                        @auth
                            <li class="nav-item mx-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-secondary" onclick="window.location = '{{ route("dashboard") }}'">{{ __(auth()->user()->name) }}</button>
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{route('add_advert')}}">Dodaj ogłoszenie</a>
                                        <a class="dropdown-item" href="#">Edytuj konto</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{route('calendar')}}">8===D xDD</a>
                                      </div>
                                </div>
                            </li>

                            <li class="nav-item mx-2">
                                <form id="my_form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-secondary font-weight-bold">{{ __('Wyloguj się') }}</button>

                                </form>
                            </li>

                        @endauth
                        
                        @guest

                            <li class="nav-item mx-2">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Logowanie') }}</a>
                            </li>

                        
                            <li class="nav-item mx-2">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Rejestracja') }}</a>
                            </li>

                        @endguest
                        
             
  
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <footer class="py-3 bg-dark fixed-bottom">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Inz 2021</p>
            </div>
        </footer>
    </div>
    <script  src="{{asset('js/add_form.js')}}"></script>
</body>
</html>
