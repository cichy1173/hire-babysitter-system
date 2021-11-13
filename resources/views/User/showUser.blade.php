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
                @if (session('status'))
                    <div class="alert alert-info" role="alert">
                        {{ session('status') }}
                    </div>                       
                @endif
                
                @if (@isset($user))
                    <div class="card-body @if($blocked == 1) bg-danger @endif">
                        @if ($blocked == 1)
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="card bg-warning">
                                        <div class="card-body">
                                            {{__('Użytkownik zablokowany')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
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
                                        </div>                                        
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
                                            @if ($blocked == 0)
                                                <button class="btn btn-outline-primary" type="button" id="button_message" data-toggle="modal" data-target="#sendToUser">{{__('Wyślij wiadomość')}}</button>
                                                @if ($opinionAvailable > 0)
                                                    <button class="btn btn-outline-success" type="button" id="button_addOpinion" data-toggle="modal" data-target="#addOpinion">{{__('Dodaj opinię')}}</button>
                                                @else
                                                    <button class="btn btn-outline-success" type="button" id="button_addOpinion" title="{{__('Nie masz zaakceptowanych zgłoszeń z użytkownikiem '.$user->name.' lub zaakceptowane zgłoszenie jeszcze nie dobiegło końca')}}" disabled>{{__('Dodaj opinię')}}</button>
                                                @endif
                                            @endif
                                            
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

                                <div class="modal fade" id="addOpinion" tabindex="-1" role="dialog" aria-labelledby="addOpinionTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addOpinionTitle">{{__('Wystaw opinię')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="form mb-0" action="{{route('addOpinion', $user)}}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="form-group col">
                                                            <div class="input-group-text mb-3">{{__('Ocena')}}</div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="opinionGradeRadio" id="opinionGradeRadio0" value="0">
                                                                <label class="form-check-label" for="opinionGradeRadio1">0</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="opinionGradeRadio" id="opinionGradeRadio1" value="1">
                                                                <label class="form-check-label" for="opinionGradeRadio1">1</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="opinionGradeRadio" id="opinionGradeRadio2" value="2">
                                                                <label class="form-check-label" for="opinionGradeRadio1">2</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="opinionGradeRadio" id="opinionGradeRadio3" value="3">
                                                                <label class="form-check-label" for="opinionGradeRadio1">3</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="opinionGradeRadio" id="opinionGradeRadio4" value="4">
                                                                <label class="form-check-label" for="opinionGradeRadio1">4</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="opinionGradeRadio" id="opinionGradeRadio5" value="5">
                                                                <label class="form-check-label" for="opinionGradeRadio1">5</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col">
                                                            <div class="input-group-text">{{__('Treść opinii')}}</div>
                                                            <textarea class="form-control" name="opinionContent" id="opinionContent" cols="30" rows="5" aria-label="Treść opinii"></textarea>                                                                                                                                                                                 
                                                        </div>
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