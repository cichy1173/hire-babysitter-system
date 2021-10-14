@extends('layouts.app')


@section('content')
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
    
                    <div class="card-body">
                        @auth (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Jesteś zalogowany!') }}
                            </div>

                            <div class="text-justify text-center">
                              Twój email: <div class="font-weight-bold"> {{ __(auth()->user()->email) }} </div>
                            
                             </div>
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