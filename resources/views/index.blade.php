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

                    @if ($adverts->count())
                            @foreach ($adverts as $advert)
                                <div class="row">
                                    <div class="col">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <form class="form-inline" action="" method="POST">
                                                    @csrf
                                                    <button class="btn btn-lg btn-link m-0 py-0 pl-0" type="submit" id="button_title">{{$advert->title}}</button>
                                                </form>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        
                                                        <form class="form-inline" action="" method="POST">
                                                            @csrf
                                                            <div class="d-inline mb-0 text-muted">{{__('Opublikował ')}}</div>
                                                            <button class="btn btn-link btn-sm" type="submit" id="button_user">{{$advert->user_nick}}</button>
                                                        </form>
                                                    </div>
                                                    <div class="col-lg-4 offset-lg-4">
                                                        <div class="d-inline mb-0 text-muted">{{__('Miasto ')}}</div>
                                                        <div class="d-inline mb-0">{{$advert->city}}</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="d-inline mb-0 text-muted">{{__('Stawka ')}}</div>
                                                        <div class="d-inline mb-0">{{$advert->hour_rate}}</div>
                                                        <div class="d-inline mb-0 text-muted">{{__(' zł/h')}}</div>
                                                    </div>
                                                    <div class="col-lg-4 offset-lg-4">
                                                        <div class="d-inline mb-0 text-muted">{{__('Dzielica ')}}</div>
                                                        <div class="d-inline mb-0">{{$advert->district}}</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="d-inline mb-0 text-muted">{{__('Liczba dzieci ')}}</div>
                                                        <div class="d-inline mb-0">{{$advert->child_num}}</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="d-inline mb-0 text-muted">{{__('Typ ogłoszenia ')}}</div>
                                                        @if ($advert->id_advertisement_type == 1)
                                                            <div class="d-inline mb-0">{{__('Szukam opiekuna')}}</div>
                                                        @else
                                                            <div class="d-inline mb-0">{{__('Jestem opiekunem')}}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6 offset-xl-8">
                                                        <div class="d-inline mb-0 text-muted">{{__('Dodano ')}}</div>
                                                        <div class="d-inline mb-0">{{$advert->created_at->diffForHumans()}}</div>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        @else
                            <p class="text-center">{{__('Nie masz żadnych ogłoszeń')}}</p>
                        @endif

                    <div class="d-flex justify-content-end">
                        {{ $adverts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
