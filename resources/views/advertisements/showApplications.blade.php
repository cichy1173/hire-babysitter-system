@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Zgłoszenia') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (isset($items) && count($items) > 0)
                        @foreach ($items as $item)
                            <div class="card mb-3 @if($item['application_type'] == 'R') border-primary @endif">
                                <div class="card-header @if($item['application_type'] == 'S') @if($item['application']->pivot->accepted == 1) alert-success @else alert-danger @endif @endif">
                                    @if($item['application_type'] == 'R')
                                        {{__('Otrzymane zgłoszenie')}}
                                    @else
                                        {{__('Wysłane zgłoszenie')}}
                                    @endif
                                </div>
                                <div class="card-body">
                                    @if($item['application_type'] == 'R')
                                        <a class="card-link" href="{{route('showSingle', $item['advert']->id)}}">
                                            <h6 class="card-title">
                                                {{$item['advert']->title}}
                                            </h6>
                                        </a>
                                        <div class="row">
                                            <div class="col">
                                                <p class="card-text text-muted d-inline">{{__('Typ ogłoszenia')}}</p>
                                                <p class="card-text d-inline">
                                                    @if($item['advert']->id_advertisement_type == 1)
                                                        {{__("Szukam opiekuna")}}
                                                    @else
                                                        {{__("Jestem opiekunem")}}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col">
                                                <p class="card-text text-muted d-inline">{{__('Stawka')}}</p>
                                                <p class="card-text d-inline">{{$item['advert']->hour_rate}}</p>
                                                <p class="card-text text-muted d-inline">{{__('zł/h')}}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <p class="card-text text-muted d-inline">{{__('Opieka od')}}</p>
                                                <p class="card-text d-inline">{{$item['advert']->supervise_from->translatedFormat('d M Y H:i')}}</p>
                                            </div>
                                            <div class="col">
                                                <p class="card-text text-muted d-inline">{{__('Opieka do')}}</p>
                                                <p class="card-text d-inline">{{$item['advert']->supervise_to->translatedFormat('d M Y H:i')}}</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                @if(auth()->user()->id_account_type == 2)
                                                    {{__("Aplikacje opiekunów")}}
                                                @else
                                                    {{__("Aplikacje rodziców")}}
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                @foreach ($item['applications'] as $application)
                                                    <div class="card mb-3 @if($item['accepted'] == 1) @if($application->pivot->accepted == 1) alert-success @else alert-danger @endif @endif">
                                                        <div class="card-body">
                                                            <p class="card-text text-muted d-inline">{{__('Użytkownik')}}</p>
                                                            <a class="card-link d-inline" href="{{route('showUser', $application)}}">
                                                                <p class="card-text d-inline">
                                                                    {{$application->nickname}}
                                                                </p>
                                                            </a>
                                                            <div class="input-group flex-nowrap d-inline">
                                                                @for ($i = 0; $i < $application->reputation; $i++)
                                                                    <span class="fa fa-star star-checked"></span>
                                                                @endfor
                                                                @for ($i = $application->reputation; $i < 5; $i++)
                                                                <span class="fa fa-star"></span>
                                                                @endfor
                                                            </div>
                                                            <div class="d-inline float-right">
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
                                                                                        <p>{{__('Odwołanie akceptacji jest niemożliwe.')}}</p>
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
                                                                    @if ($application->pivot->accepted == 0)
                                                                        <button class="btn btn-secondary" disabled>{{__('Wybór niemożliwy')}}</button>
                                                                    @else
                                                                        <button class="btn btn-success" disabled>{{__('Zaakceptowany')}}</button>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <a class="card-link" href="{{route('showSingle', $item['advert']->id)}}">
                                            <h6 class="card-title">
                                                {{$item['advert']->title}}
                                            </h6>
                                        </a>
                                        <div class="row">
                                            <div class="col">
                                                <p class="card-text text-muted d-inline">{{__('Typ ogłoszenia')}}</p>
                                                <p class="card-text d-inline">
                                                    @if($item['advert']->id_advertisement_type == 1)
                                                        {{__("Szukam opiekuna")}}
                                                    @else
                                                        {{__("Jestem opiekunem")}}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col">
                                                <p class="card-text text-muted d-inline">{{__('Stawka')}}</p>
                                                <p class="card-text d-inline">{{$item['advert']->hour_rate}}</p>
                                                <p class="card-text text-muted d-inline">{{__('zł/h')}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p class="card-text text-muted d-inline">{{__('Opieka od')}}</p>
                                                <p class="card-text d-inline">{{$item['advert']->supervise_from->translatedFormat('d M Y H:i')}}</p>
                                            </div>
                                            <div class="col">
                                                <p class="card-text text-muted d-inline">{{__('Opieka do')}}</p>
                                                <p class="card-text d-inline">{{$item['advert']->supervise_to->translatedFormat('d M Y H:i')}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p class="card-text text-muted d-inline">{{__('Użytkownik')}}</p>
                                                <a class="card-link d-inline" href="{{route('showUser', $item['application'])}}">
                                                    <p class="card-text d-inline">
                                                        {{$item['application']->nickname}}
                                                    </p>
                                                </a>
                                                <div class="input-group flex-nowrap d-inline">
                                                    @for ($i = 0; $i < $item['application']->reputation; $i++)
                                                        <span class="fa fa-star star-checked"></span>
                                                    @endfor
                                                    @for ($i = $item['application']->reputation; $i < 5; $i++)
                                                    <span class="fa fa-star"></span>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-end">
                            {{$items->links()}}
                        </div>
                    @else
                        <div class="text-center">{{__('Obecnie nie masz żadnych zgłoszeń')}}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
