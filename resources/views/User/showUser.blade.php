@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                @if (@isset($user))
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card mb-3">
                                    @if ($user->photo == "")
                                        <img class="card-img" src="{{asset('storage/profilePhotos/defaultUser.png')}}" alt="User image">
                                    @else
                                        <img class="card-img" src="{{asset($user->photo)}}" alt="User image">
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-inline mb-0 text-muted">{{__('Imię ')}}</div>
                                        <div class="d-inline mb-0">{{$user->name}}</div>                                        
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-inline mb-0 text-muted">{{__('Nazwisko ')}}</div>
                                        <div class="d-inline mb-0">{{$user->surname}}</div>                                        
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-inline mb-0 text-muted">{{__('Nick ')}}</div>
                                        <div class="d-inline mb-0">{{$user->nickname}}</div>                                        
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-inline mb-1 text-muted">{{__('Reputacja ')}}</div>
                                        <div class="d-inline mb-0">
                                            <div class="mx-auto">
                                                <span class="fa fa-star star-checked"></span>
                                                <span class="fa fa-star star-checked"></span>
                                                <span class="fa fa-star star-checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                            </div>
                                        </a></div>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-0 text-muted">{{__('Opis')}}</div>
                                        <p class="card-text text-justify">{{$user->about}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form class="form float-right" method="POST" action="">
                                    @csrf
                                    <button class="btn btn-outline-primary" type="submit" id="button_message">{{__('Wyślij wiadomość')}}</button>
                                    <button class="btn btn-outline-dark" type="submit" id="button_message">{{__('Wystaw opinię')}}</button>
                                </form>
                            </div>                            
                        </div>
                    </div>                        
                @else
                    <p class="text-center">{{__('Nie ma takiego użytkownika')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection