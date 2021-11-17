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
                        @foreach ($cals as $cal)
                            <div class="row">
                                <div class="col">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="d-inline mb-0 text-muted">{{__('Zleceniodawca ')}}</div>
                                            <a href="{{route('showUser', $cal->id_user)}}" class="font-weight-bold mb-0">{{$cal->nickname}}</a>                                            
                                        </div>
                                        <div class="card-body ">
                                            <div class="row h-auto" style="margin-left:1px">                                                                                                   
                                                <div class="col h-auto">
                                                    <div class="row d-inline-block" style="font-size: large">
                                                        <div class=" d-inline mb-0 text-muted" style="font-weight:bold">{{__('Rozpoczęcie: ')}}</div>                                                        
                                                        <div class="d-inline mb-0" >{{ \Carbon\Carbon::parse($cal->time_from)->translatedFormat('d F Y H:i') }}</div>                                                       
                                                    </div>
                                                    
                                                    <div class="row ">
                                                        <div class="d-inline mb-0 text-muted">{{__('Stawka: ')}}</div>
                                                        <div class="d-inline mb-0 ">{{$cal->hour_rate}}</div>
                                                        <div class="d-inline mb-0 text-muted">{{__('zl/h ')}}</div>
                                                    </div>

                                                    <div class="row ">
                                                        <div class="d-inline mb-0 text-muted">{{__('Liczba dzieci: ')}}</div>
                                                        <div class="d-inline mb-0">{{$cal->child_num}}</div>
                                                    </div>
                                                </div>
                                                                                                                                                             
                                                                                              
                                                <div class="col h-auto">                                            
                                                    <div class="row d-inline-block" style="font-size: large">
                                                        <div class="d-inline mb-0 text-muted" style="font-weight:bold">{{__(' Zakończenie: ')}}</div>
                                                        <div class="d-inline mb-0" >{{\Carbon\Carbon::parse($cal->time_to)->translatedFormat('d F Y H:i')}}</div>
                                                    </div>
                                                    <div class="row d-inline-block">
                                                        <div class=" d-inline mb-0 text-muted">{{__('Lokalizacja: ')}}</div>
                                                        <div class=" d-inline mb-0">{{$cal->district_name}}</div>
                                                    </div>
                                                    <div class="row ">
                                                        <div class="d-inline mb-0 text-muted">{{__('Zaakceptowane: ')}}</div>
                                                        <div class="d-inline mb-0">Tak</div> 
                                                    </div>
                                                </div>                                                 
                                            </div>     
                                        </div>
                                    </div>
                                </div>
                            </div>                     
                        @endforeach
                        
                        

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