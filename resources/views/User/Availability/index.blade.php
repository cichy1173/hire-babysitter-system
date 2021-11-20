@extends('layouts.app')


@section('content')
@auth
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dostępność') }}</div>
    
                    <div class="card-body">
                        <div class="list-group text-center">
        
                            <a href="{{ route('availability.availability.edit', $day = '1') }}" class="list-group-item list-group-item-action list-group-item-info">Poniedziałek</a>
                            <a href="#" class="list-group-item list-group-item-action list-group-item-info">Wtorek</a>
                            <a href="#" class="list-group-item list-group-item-action list-group-item-info">Środa</a>
                            <a href="#" class="list-group-item list-group-item-action list-group-item-info">Czwartek</a>
                            <a href="#" class="list-group-item list-group-item-action list-group-item-info">Piątek</a>
                            <a href="#" class="list-group-item list-group-item-action list-group-item-warning">Sobota</a>
                            <a href="#" class="list-group-item list-group-item-action list-group-item-warning">Niedziela</a>
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