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

    <!-- Stars-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/stars.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <img src="{{ asset('images/niania-logo.avif') }}"  width="45" alt="" class="d-inline-block align-middle mr-2">
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
                            <form class="form-inline" action="{{route('search')}}" method="GET">
                                <input type="text" class="form-control mr-1" id="search" name="search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">{{__("Wyszukaj")}}</button>
                            </form>
                        </li>
                        <!-- Authentication Links -->

                        @auth
                            <li class="nav-item mx-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-secondary" id="userButton" name="userButton" onclick="window.location = '{{ route("dashboard") }}'">{{auth()->user()->nickname}}</button>
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="bg-info dropdown-item" href="{{route('add_advert')}}">{{__('Dodaj ogłoszenie')}}</a>
                                        <a class="dropdown-item" href="{{route('show_advert')}}">{{__('Moje ogłoszenia')}}</a>
                                        <a class="dropdown-item" href="{{route('userOpinions', auth()->user())}}">{{__('Moje opinie')}}</a>
                                        <a class="dropdown-item" href="{{route('showApplications')}}" id="applications" name="applications">{{__('Zgłoszenia')}}</a>
                                        <a class="dropdown-item" href="{{ route('userEdit') }}">{{__('Edytuj konto')}}</a>
                                        <a class="dropdown-item" href="{{route('messageList', auth()->user())}}" id="userMessages" name="userMessages">{{__('Wiadomości')}}</a>
                                        <a class="dropdown-item" href="{{ route('calendar') }}">{{__('Grafik')}}</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">{{__('Dodatki')}}</a>
                                      </div>
                                </div>
                            </li>

                            @admin

                                <li class="nav-item mx-2">
                                    <a class=" btn btn-outline-danger font-weight-bold" href="{{ route('admin.users.index') }}">{{ __('Administrator') }}</a>
                                </li>

                            @endadmin


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

        <main class="py-4 mb-4">
            @yield('content')
        </main>
        <footer class="py-3 bg-dark fixed-bottom">
            <div class="container">
                <p class="m-0 text-center text-white">Copyright &copy; Inz 2021</p>
            </div>
        </footer>
    </div>

    <script  src="{{asset('js/add_form.js')}}"></script>
    <script>
        $(document).ready(function()
        {
            var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";

            if( AuthUser != null)
            {
                $.ajax({
                    url: '/messages/badges',
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        if(Object.keys(response).length > 0)
                        {
                            let userButton = $('#userButton').html();
                            let userMessages = $('#userMessages').html();
                            let userApplications = $('#applications').html();
                            let countAll = response['messages'] + response['applications'];
                            
                            

                            if(countAll > 0)
                            {
                                let badgeMain = '<span class="badge badge-danger">'+ countAll +'</span>';
                                $('#userButton').html(userButton + ' ' + badgeMain);
                            }

                            if(response['messages'] > 0)
                            {
                                let badgeMessages = '<span class="badge badge-danger">'+ response['messages'] +'</span>';
                                $('#userMessages').html(userMessages + ' ' + badgeMessages);
                            }
                            
                            if(response['applications'] > 0)
                            {
                                let badgeApplications = '<span class="badge badge-danger">'+ response['applications'] +'</span>';
                                $('#applications').html(userApplications + ' ' + badgeApplications);
                            }
                        }                    
                    }
                });
            }            
        });
    </script>
</body>
</html>
