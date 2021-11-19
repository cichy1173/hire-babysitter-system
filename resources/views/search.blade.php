@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Wyniki wyszukiwania') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="advert-tab" data-toggle="tab" href="#advert" role="tab" aria-controls="advert" aria-selected="true">{{__('Ogłoszenia')}}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="false">{{__('Użytkownicy')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="advert" role="tabpanel" aria-labelledby="advert-tab">
                            @if (isset($adverts) && count($adverts) > 0)
                                @foreach ($adverts as $item)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <a href="{{route('showSingle', $item)}}"><p class="mb-0">{{$item->title}}</p></a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <p class="d-inline text-muted">{{__('Opublikował')}}</p>
                                                    <a href="{{route('showUser', $item['user'])}}"><p class="d-inline">{{$item['user']->nickname}}</p></a>
                                                    <p class="d-inline">
                                                        <div class="mx-auto d-inline">
                                                            @for ($i = 0; $i < $item['user']->reputation; $i++)
                                                                <span class="fa fa-star star-checked d-inline"></span>
                                                            @endfor
                                                            @for ($i = $item['user']->reputation; $i < 5; $i++)
                                                                <span class="fa fa-star d-inline"></span>
                                                            @endfor
                                                        </div>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <p class="d-inline text-muted">{{__('Typ ogłoszenia')}}</p>
                                                    @if ($item->id_advert_type == 1)
                                                        <p class="d-inline">{{__('Szukam opiekuna')}}</p>    
                                                    @else
                                                        <p class="d-inline">{{__('Jestem opiekunem')}}</p>    
                                                    @endif                                                        
                                                </div>
                                                <div class="col">
                                                    <p class="d-inline text-muted">{{__('Stawka')}}</p>
                                                    <p class="d-inline">{{$item->hour_rate}}</p>
                                                    <p class="d-inline text-muted">{{__('zł/h')}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <p class="d-inline text-muted">{{__('Miasto')}}</p>
                                                    <p class="d-inline">{{$item['city']->city_name}}</p>
                                                </div>
                                                <div class="col">
                                                    <p class="d-inline text-muted">{{__('Dzielnica')}}</p>
                                                    <p class="d-inline">{{$item['district']->district_name}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-end">
                                    {{ $adverts->links() }}
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-center mb-0">{{__('Brak wyników')}}</p>
                                    </div>
                                </div>                                
                            @endif
                        </div>
                        <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab">
                            @if (isset($users) && count($users) > 0)
                                @foreach ($users as $item)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <a href="{{route('showUser', $item)}}"><p class="mb-0">{{$item->nickname}}</p></a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <p class="d-inline text-muted">{{__('Imię')}}</p>
                                                    <p class="d-inline">{{$item->name}}</p>
                                                </div>
                                                <div class="col">
                                                    <p class="d-inline text-muted">{{__('Nazwisko')}}</p>
                                                    <p class="d-inline">{{$item->surname}}</p>
                                                </div>
                                                <div class="col">
                                                    <p class="d-inline text-muted">{{__('Reputacja')}}</p>
                                                    <p class="d-inline">
                                                        <div class="mx-auto d-inline">
                                                            @for ($i = 0; $i < $item->reputation; $i++)
                                                                <span class="fa fa-star star-checked d-inline"></span>
                                                            @endfor
                                                            @for ($i = $item->reputation; $i < 5; $i++)
                                                                <span class="fa fa-star d-inline"></span>
                                                            @endfor
                                                        </div>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-end">
                                    {{ $users->links() }}
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-center mb-0">{{__('Brak wyników')}}</p>
                                    </div>
                                </div>                                
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection