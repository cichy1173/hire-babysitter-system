@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ogłoszenia') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if ($notifications > 0)
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card text-center">
                                    <div class="card-body bg-info">
                                        @if ($notifications == 1)
                                            {{__('Masz '.$notifications.' użytkownika, któremu możesz wystawić opinię')}}
                                        @else
                                            {{__('Masz '.$notifications.' użytkowników, którym możesz wystawić opinię')}}
                                        @endif                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (count($items) > 0)
                            @foreach ($items as $item)
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <p class="mb-0">{{$item['advert']->title}}</p>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="d-inline mb-0 text-muted">{{__('Stawka ')}}</div>
                                                        <div class="d-inline mb-0">{{$item['advert']->hour_rate}}</div>
                                                        <div class="d-inline mb-0 text-muted">{{__(' zł/h')}}</div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="d-inline mb-0 text-muted">{{__('Liczba dzieci ')}}</div>
                                                        <div class="d-inline mb-0">{{$item['advert']->child_num}}</div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <div class="d-inline mb-0 text-muted">{{__('Typ ogłoszenia ')}}</div>
                                                        @if ($item['advert']->id_advertisement_type == 1)
                                                            <div class="d-inline mb-0">{{__('Szukam opiekuna')}}</div>
                                                        @else
                                                            <div class="d-inline mb-0">{{__('Jestem opiekunem')}}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col">
                                                        <div class="d-inline mb-0 text-muted">{{__('Dodano ')}}</div>
                                                        <div class="d-inline mb-0">{{$item['advert']->created_at->diffForHumans()}}</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card mb-3">
                                                            <div class="card-header">
                                                                <p class="mb-0">{{__('Aplikacje użytkowników')}}</p>
                                                            </div>
                                                            <div class="card-body">
                                                                @foreach ($item['applications'] as $application)
                                                                    <div class="row mb-3">
                                                                        <div class="col">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <form class="form" method="GET" action="{{route('showUser', $application)}}">
                                                                                                @csrf
                                                                                                <button class="btn btn-link mb-0 p-0" type="submit">{{$application->nickname}}</button>
                                                                                                <div class="input-group flex-nowrap d-inline">
                                                                                                    @for ($i = 0; $i < $application->reputation; $i++)
                                                                                                        <span class="fa fa-star star-checked"></span>
                                                                                                    @endfor
                                                                                                    @for ($i = $application->reputation; $i < 5; $i++)
                                                                                                    <span class="fa fa-star"></span>
                                                                                                    @endfor
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="float-right">
                                                                                                @if ($item['accepted'] == 0)
                                                                                                    <button class="btn btn-outline-success" type="button" id="{{$application->id}}" data-toggle="modal" data-target="#acceptUser{{$application->id}}">{{__('Zaakceptuj')}}</button>

                                                                                                    <div class="modal fade" id="acceptUser{{$application->id}}" tabindex="-1" role="dialog" aria-labelledby="acceptUserTitle" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                                            <div class="modal-content">
                                                                                                                <div class="modal-header">
                                                                                                                    <h5 class="modal-title" id="aacceptUserTitle">{{__('Zaakceptuj użytkownika')}}</h5>
                                                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                                                                                        <span aria-hidden="true">&times;</span>
                                                                                                                    </button>
                                                                                                                </div>
                                                                                                                <form class="form mb-0" action="{{route('acceptUser')}}" method="POST">
                                                                                                                    @csrf
                                                                                                                    <input type="text" name="advert" id="advert" value="{{$item['advert']->id}}" hidden>
                                                                                                                    <input type="text" name="user" id="user" value="{{$application->id}}" hidden>
                                                                                                                    <div class="modal-body bg-warning">
                                                                                                                        <p>{{__('Czy jesteś pewien, że chcesz zaakceptować tego użytkownika?')}}</p>
                                                                                                                        <p>{{__('Odpołanie akceptacji jest niemożliwe.')}}</p>
                                                                                                                        <p>{{__('Wybrany użytkownik zostanie powiadomiony o wyborze.')}}</p>
                                                                                                                    </div> 
                                                                                                                    <div class="modal-footer">
                                                                                                                        <button type="submit" id="buttonSend" class="btn btn-outline-success">{{__('Tak')}}</button>
                                                                                                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{__('Nie')}}</button>
                                                                                                                    </div>                                       
                                                                                                                </form>                                            
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @else
                                                                                                    @if ($application['accepted'] == 0)
                                                                                                        <button class="btn btn-secondary float-right" disabled>{{__('Wybór niemożliwy')}}</button>
                                                                                                    @else
                                                                                                        <button class="btn btn-success float-right" disabled>{{__('Zaakceptowany')}}</button>
                                                                                                    @endif
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>      
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        @else
                            <p class="text-center">{{__('Nie otrzymałeś żadnych zgłoszeń')}}</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
