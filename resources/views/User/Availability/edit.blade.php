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
                    <div  class="alert alert-info  " role="alert">
                            Edytujesz dzień: @if($day == 1) <b>Poniedziałek</b>
                            @elseif($day == 2) <b>Wtorek</b>
                            @elseif($day == 3) <b>Środa</b>
                            @elseif($day == 4) <b>Czwartek</b>
                            @elseif($day == 5) <b>Piątek</b>
                            @elseif($day == 6) <b>Sobota</b>
                            @else <b>Niedziela</b>
                        @endif
                       </div>

                        <form method="post" action="{{route('availability.availability.update', $day)}}">
                        @csrf
                        @method('PUT')

                            <div class="form-group">

                                <label class="col-form-label" for="start_time">Dostępność od:</label>
                                <div class="">
                                <input type="time" class="form-control" name="start_time" id="start_time">
                                </div>

                                <label class="col-form-label" for="stop_time">Dostępność do:</label>
                                <div class="">
                                <input type="time" class="form-control" name="stop_time" id="stop_time">
                                </div>
    
                            </div>

                            <div class="mb-1 row">
                                <div class="col">
                                    <div class="form-group float-right">
                                        
                                        <button class="btn btn-outline-success" type="submit" id="button_submit">{{__("Zapisz")}}</button>
                                    </div>
                                </div>
                            </div>

                        </form>
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