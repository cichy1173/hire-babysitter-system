@extends('layouts.app')


@section('content')
@auth
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


            @if (session('success'))
            <div class="text-center alert alert-success ">
                {{ session('success') }}    
               
            </div>
            @endif
                <div class="card">
                    <div class="card-header">{{ __('Dostępność') }}</div>
    
                    <div class="card-body">

                    
                        <div class=" p-2 list-group text-center">
        
                            <a href="{{ route('availability.availability.edit', $day = '1') }}" class="list-group-item list-group-item-action list-group-item-info">Poniedziałek</a>
                            <a href="{{ route('availability.availability.edit', $day = '2') }}" class="list-group-item list-group-item-action list-group-item-info">Wtorek</a>
                            <a href="{{ route('availability.availability.edit', $day = '3') }}" class="list-group-item list-group-item-action list-group-item-info">Środa</a>
                            <a href="{{ route('availability.availability.edit', $day = '4') }}" class="list-group-item list-group-item-action list-group-item-info">Czwartek</a>
                            <a href="{{ route('availability.availability.edit', $day = '5') }}" class="list-group-item list-group-item-action list-group-item-info">Piątek</a>
                            <a href="{{ route('availability.availability.edit', $day = '6') }}" class="list-group-item list-group-item-action list-group-item-warning">Sobota</a>
                            <a href="{{ route('availability.availability.edit', $day = '7') }}" class="list-group-item list-group-item-action list-group-item-warning">Niedziela</a>
                       
                        </div>

                        <div class="p-2">

                            <button type="button" data-toggle="modal" data-target="#showAvailability" class="p-2 btn btn-outline-success btn-lg btn-block">Podejrzyj dostępność</button>

                        </div>


                                    <div class="modal fade" id="showAvailability" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="showAvailability">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold" id="showAvailability">{{__('Twoja dostępność w dane dni: ')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                               <p> <b>Poniedziałek: </b>
                                                  @if($monday == null) <i>Nie podano dostępności</i>
                                                  @else Od {{$monday->start_time}} do {{ $monday->stop_time }}
                                                  @endif </p>

                                                 <p> <b>Wtorek: </b>
                                                  @if($tuesday == null) <i>Nie podano dostępności</i>
                                                  @else Od {{$tuesday->start_time}} do {{ $tuesday->stop_time }}
                                                  @endif <p>

                                                    <p> <b>Środa: </b>
                                                  @if($wednesday == null) <i>Nie podano dostępności</i>
                                                  @else Od {{$wednesday->start_time}} do {{ $wednesday->stop_time }}
                                                  @endif <p>

                                                  <p> <b>Czwartek: </b>
                                                  @if($thursday == null) <i>Nie podano dostępności</i>
                                                  @else Od {{$thursday->start_time}} do {{ $thursday->stop_time }}
                                                  @endif <p>

                                                <p> <b>Piątek: </b>
                                                  @if($friday == null) <i>Nie podano dostępności</i>
                                                  @else Od {{$friday->start_time}} do {{ $friday->stop_time }}
                                                  @endif <p>

                                                    <p> <b>Sobota: </b>
                                                  @if($saturday == null) <i>Nie podano dostępności</i>
                                                  @else Od {{$saturday->start_time}} do {{ $saturday->stop_time }}
                                                  @endif <p>

                                                    <p> <b>Niedziela: </b>
                                                  @if($sunday == null)  <i>Nie podano dostępności</i>
                                                  @else Od {{$sunday->start_time}} do {{ $sunday->stop_time }}
                                                  @endif <p>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Zamknij')}}</button>
                                                </div>
                                            </div>
                                        </div>
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