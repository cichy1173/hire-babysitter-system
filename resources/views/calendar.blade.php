@extends('layouts.app')

@section('content')

<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <div class="card">
                    <div class="card-header" align="center" vlign="middle">{{ __('Grafik') }}</div>
    
                    <div class="card-body">
                        @auth
                         
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Godzina rozpoczęcia</th>
                                    <th scope="col">Godzina zakończenia</th>
                                    <th scope="col">Czy akceptowane?</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cals as $cal)
                                    @if(Auth::user()->id == $cal->id_user)
                                        <tr>
                                            <th scope="row">{{ $cal->time_from }}</th>
                                            <th scope="row">{{ $cal->time_to }}</th>
                                            <th scope="row">@if($cal->accepted == '1')Tak</th> @endif
                                            

                                        </tr>
                                    @endif
                                        
                                    @endforeach
                              
                                </tbody>
                            </table>

                        @endauth

                        @guest
                        <div class="alert alert-info" role="alert">
                            {{ __('Aby zobaczyć więcej, zaloguj się') }}
                        </div>
                        @endguest
    
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection