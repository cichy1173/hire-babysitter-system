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
                                                @for ($i = 0; $i < $user->reputation; $i++)
                                                    <span class="fa fa-star star-checked"></span>
                                                @endfor
                                                @for ($i = $user->reputation; $i < 5; $i++)
                                                <span class="fa fa-star"></span>
                                                @endfor
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
                        @auth
                            @if (auth()->id() == $user->id)
                                
                            @else
                                <div class="row">
                                    <div class="col">
                                        <div class="float-right">
                                            <button class="btn btn-outline-primary" type="button" id="button_message" data-toggle="modal" data-target="#sendToUser">{{__('Wyślij wiadomość')}}</button>
                                            <button class="btn btn-outline-success" type="button" id="button_accept">{{__('Dodaj opinię')}}</button>
                                        </div>
                                    </div>                            
                                </div>

                                <div class="modal fade" id="sendToUser" tabindex="-1" role="dialog" aria-labelledby="sendToUserTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="sendToUserTitle">{{__('Wyślij wiadomość')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="form mb-0" action="{{route('newMessage', auth()->user())}}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="input-group">
                                                        <input type="text" name="userTo" id="userTo" value="{{$user->id}}" hidden>
                                                        <input class="form-control" type="text" id="userMessage" name="userMessage" required aria-describedby="buttonSend">                                                        
                                                    </div>
                                                </div> 
                                                <div class="modal-footer">
                                                    <button type="submit" id="buttonSend" class="btn btn-outline-success">{{__('Wyślij')}}</button>
                                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">{{__('Anuluj')}}</button>
                                                </div>                                       
                                            </form>                                            
                                        </div>
                                    </div>
                                </div>
                            @endif      
                        @endauth     
                    </div>                        
                @else
                    <p class="text-center">{{__('Nie ma takiego użytkownika')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection