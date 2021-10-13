@extends('layouts.app')


@section('content')
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard 2') }}</div>
    
                    <div class="card-body">
                        @auth (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Jesteś zalogowany!') }}
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