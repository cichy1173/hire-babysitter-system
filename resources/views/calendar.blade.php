@extends('layouts.app')

@section('content')

<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Grafik') }}</div>
                    <div class="card-body">
                        
                        @auth
                            @if(isset($cals) && count($cals) > 0)
                                @foreach ($cals as $cal)
                                    <div class="row">
                                        <div class="col">
                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    <div class="d-inline mb-0 text-muted">{{__('Zleceniodawca ')}}</div>
                                                    <a href="{{route('showUser', $cal->id_user)}}" class="font-weight-bold mb-0">{{$cal->nickname}}</a>                                            
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class=" d-inline mb-0 text-muted">{{__('Rozpoczęcie: ')}}</p>                                                        
                                                            <p class="d-inline mb-0" >{{ \Carbon\Carbon::parse($cal->time_from)->translatedFormat('d F Y H:i') }}</p>                     
                                                        </div>     
                                                        <div class="col">
                                                            <p class="d-inline mb-0 text-muted">{{__(' Zakończenie: ')}}</p>
                                                            <p class="d-inline mb-0" >{{\Carbon\Carbon::parse($cal->time_to)->translatedFormat('d F Y H:i')}}</p>
                                                        </div>                             
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="d-inline mb-0 text-muted">{{__('Stawka: ')}}</p>
                                                            <p class="d-inline mb-0 ">{{$cal->hour_rate}}</p>
                                                            <p class="d-inline mb-0 text-muted">{{__('zl/h ')}}</p>                   
                                                        </div>     
                                                        <div class="col">
                                                            <p class=" d-inline mb-0 text-muted">{{__('Lokalizacja: ')}}</p>
                                                            <p class=" d-inline mb-0">{{$cal->district_name}}</p>
                                                        </div>                             
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="d-inline mb-0 text-muted">{{__('Liczba dzieci: ')}}</p>
                                                            <p class="d-inline mb-0">{{$cal->child_num}}</p>                   
                                                        </div>     
                                                        <div class="col">
                                                            <p class="d-inline mb-0 text-muted">{{__('Zaakceptowane: ')}}</p>
                                                            <p class="d-inline mb-0">{{__('Tak')}}</p> 
                                                        </div>                             
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                     
                                @endforeach  
                                <div style="float: right"><a class="btn btn-primary" href="{{ route('calendarsend') }}" role="button">{{__('Wyślij Grafik')}}</a></div>
                            @else
                                <p class="text-center alert alert-info mb-0">{{__('Obecnie nie masz żadnych zaakceptowanych zgłoszeń. Grafik niedostepny')}}</p>
                            @endif
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