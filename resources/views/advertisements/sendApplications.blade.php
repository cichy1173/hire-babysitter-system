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
                                                <div class="row">
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
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <form class="form mb-0" method="GET" action="{{route('showUser', $item['advert_user'])}}">
                                                            @csrf
                                                            <div class="d-inline mb-0 text-muted">{{__('Opublikował ')}}</div>
                                                            <button class="btn btn-link btn mb-0 p-0" type="submit">{{$item['advert_user']->nickname}}</button>
                                                            <div class="input-group flex-nowrap d-inline">
                                                                @for ($i = 0; $i < $item['advert_user']->reputation; $i++)
                                                                    <span class="fa fa-star star-checked"></span>
                                                                @endfor
                                                                @for ($i = $item['advert_user']->reputation; $i < 5; $i++)
                                                                <span class="fa fa-star"></span>
                                                                @endfor
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card">
                                                            @if ($item['accepted'] == 1)
                                                                <div class="card-body bg-success">
                                                                    {{__('Aplikacja zaakceptowana')}}
                                                                </div>
                                                            @else
                                                                <div class="card-body bg-danger">
                                                                    {{__('Aplikacja niezaakceptowana')}}
                                                                </div>
                                                            @endif                                                            
                                                        </div>
                                                    </div>
                                                </div>               
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        @else
                            <p class="text-center">{{__('Nie wysłałeś żadnych zgłoszeń')}}</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
