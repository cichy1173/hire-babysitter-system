<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('niania-logo.avif')}}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <img src="{{ asset('niania-logo.avif') }}" width="45" alt="" class="d-inline-block align-middle mr-2">
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
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item px-4">
                                <form class="form-inline">
                                    <input type="search" class="form-control mr-sm-2" >
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">{{__("Wyszukaj")}}</button>
                                </form>
                            </li>
                        </ul>
                        <!-- Authentication Links -->

                        @auth
                              <li class="nav-item">
                                    <a class="font-weight-bold nav-link" href="{{ route('dashboard') }}">{{ __(auth()->user()->name) }}</a>
                                </li>

                                <li class="nav-item">
                                    <form id="my_form" action="{{ route('logout') }}" method="POST" class="text-center">
                                        @csrf
                                        <button class="btn btn-outline-secondary font-weight-bold nav-link text-center">{{ __('Wyloguj się') }}</button>

                                    </form>
                                </li>

                        @endauth
                        
                        @guest

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Logowanie') }}</a>
                            </li>

                        
                            <li class="nav-item">
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
