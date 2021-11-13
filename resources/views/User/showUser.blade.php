@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
            <div class="text-center alert alert-success ">
                {{ session('success') }}    
               
            </div>
            @endif
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
                                        
                                        @if(!($user->id_account_type == '3'))
                                                @if(auth()->user()->id_account_type == '3')
                                                
                                                <div class="float-left">
                                                    <button type="button" data-toggle="modal" data-target="#deleteAccountPopUp" class=" btn btn-outline-danger">{{ __('Usuń użytkownika') }}</button>

                                            <div class="modal fade" id="deleteAccountPopUp" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="deleteAccountPopUp">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteAccountPopUp">{{__('Czy jesteś pewien, że chcesz usunąć użytkownika?')}}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{__('Czy jesteś pewien, że chcesz usunąć tego użytkownika?')}}</p>
                                                            <p>{{__('Usunięcie użytkownika jest bezpowrotne!')}}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Zamknij')}}</button>
                                                            <button type="button" class="btn btn-danger"
                                                            onclick="event.preventDefault();  document.getElementById('delete-user-form-{{ $user->id }}').submit() " >
                                                            Usuń użytkownika
                                                        </button> 
                                                            <form id="delete-user-form-{{ $user->id }}" action="{{ route('showUser.destroy', $user->id) }}" method="POST" style="display: none">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  

                                            @if ($user->is_blocked == 0)

                                            <button type="button" class="btn btn-outline-warning"
                                            onclick="event.preventDefault();  document.getElementById('block-user-form-{{ $user->id }}').submit() " >
                                                Zablokuj
                                            </button> 

                                            <form id="block-user-form-{{ $user->id }}" action="{{ route('admin.users.block', $user->id) }}" method="POST" style="display: none">
                                                @csrf
                                            </form>

                                            @elseif ($user->is_blocked == 1)
                                            <button type="button" class="btn btn-outline-success"
                                            onclick="event.preventDefault();  document.getElementById('unblock-user-form-{{ $user->id }}').submit() " >
                                                Odblokuj
                                            </button> 

                                            <form id="unblock-user-form-{{ $user->id }}" action="{{ route('admin.users.unblock', $user->id) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            @endif
                                                </div>
                                        
                                        @endif
                                        @endif
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