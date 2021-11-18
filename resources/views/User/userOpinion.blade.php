@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header">{{ __('Opinie') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-error" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (isset($items) && count($items) > 0)
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="mb-0 text-center">
                                            {{__('Otrzymane opinie')}}
                                        </p>
                                    </div>
                                    <div class="card-body">
                                        @if (isset($items['receivedOpinions']) && count($items['receivedOpinions']) > 0)
                                            @foreach ($items['receivedOpinions'] as $received)
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        <a href="{{route('showUser', $received['user'])}}">
                                                            <p class="d-inline mb-0">{{$received['user']->nickname}}</p>
                                                        </a>
                                                        <p class="mb-0 d-inline float-right">{{$received->created_at->translatedFormat('Y F d H:i')}}</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="text-muted d-inline">
                                                            {{__('Ocena')}}
                                                        </p>
                                                        <p class="d-inline">
                                                            <div class="mx-auto d-inline">
                                                                @for ($i = 0; $i < $received->grade; $i++)
                                                                    <span class="fa fa-star star-checked d-inline"></span>
                                                                @endfor
                                                                @for ($i = $received->grade; $i < 5; $i++)
                                                                <span class="fa fa-star d-inline"></span>
                                                                @endfor
                                                            </div>
                                                        </p>
                                                        <p class="text-justify mb-0">
                                                            {{$received->content}}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-center mb-0">{{__('Na razie nie otrzymałeś żadnych opinii')}}</p>                                 
                                        @endif
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="mb-0 text-center">
                                            {{__('Wysłane opinie')}}
                                        </p>
                                    </div>
                                    <div class="card-body">
                                        @if (isset($items['sendOpinions']) && count($items['sendOpinions']) > 0)
                                            @foreach ($items['sendOpinions'] as $send)
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        <a href="{{route('showUser', $send['user'])}}">
                                                            <p class="d-inline mb-0">{{$send['user']->nickname}}</p>
                                                        </a>
                                                        <p class="mb-0 d-inline float-right">{{$send->created_at->translatedFormat('Y F d H:i')}}</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="text-muted d-inline">
                                                            {{__('Ocena')}}
                                                        </p>
                                                        <p class="d-inline">
                                                            <div class="mx-auto d-inline">
                                                                @for ($i = 0; $i < $send->grade; $i++)
                                                                    <span class="fa fa-star star-checked d-inline"></span>
                                                                @endfor
                                                                @for ($i = $send->grade; $i < 5; $i++)
                                                                <span class="fa fa-star d-inline"></span>
                                                                @endfor
                                                            </div>
                                                        </p>
                                                        <p class="text-justify mb-0">
                                                            {{$send->content}}
                                                        </p>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="float-right">
                                                            <button class="btn btn-sm btn-warning d-inlnie" data-toggle="modal" data-target="#editPopUp{{$send->id}}">{{__('Edytuj')}}</button>
                                                            <button class="btn btn-sm btn-danger d-inlnie" data-toggle="modal" data-target="#deletePopUp{{$send->id}}">{{__('Usuń')}}</button>
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="editPopUp{{$send->id}}" name="{{$send->id}}" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="editPopUpTitle{{$send->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editPopUpTitle{{$send->id}}">{{__('Edycja opinii')}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form class="form mb-0 text-center" id="{{$send->id}}" name="{{$send->id}}" action="{{route('editOpinion', $send)}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="form-row">
                                                                        <div class="form-group col">
                                                                            <div class="input-group-text mb-3">{{__('Ocena')}}</div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="opinionGradeRadio" id="opinionGradeRadio0" value="0" @if($send->grade == 0) checked @endif>
                                                                                <label class="form-check-label" for="opinionGradeRadio1">0</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="opinionGradeRadio" id="opinionGradeRadio1" value="1" @if($send->grade == 1) checked @endif>
                                                                                <label class="form-check-label" for="opinionGradeRadio1">1</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="opinionGradeRadio" id="opinionGradeRadio2" value="2" @if($send->grade == 2) checked @endif>
                                                                                <label class="form-check-label" for="opinionGradeRadio1">2</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="opinionGradeRadio" id="opinionGradeRadio3" value="3" @if($send->grade == 3) checked @endif>
                                                                                <label class="form-check-label" for="opinionGradeRadio1">3</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="opinionGradeRadio" id="opinionGradeRadio4" value="4" @if($send->grade == 4) checked @endif>
                                                                                <label class="form-check-label" for="opinionGradeRadio1">4</label>
                                                                            </div>
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="radio" name="opinionGradeRadio" id="opinionGradeRadio5" value="5" @if($send->grade == 5) checked @endif>
                                                                                <label class="form-check-label" for="opinionGradeRadio1">5</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col">
                                                                            <div class="input-group-text">{{__('Treść opinii')}}</div>
                                                                            <textarea class="form-control" name="opinionContent" id="opinionContent" cols="30" rows="5" aria-label="Treść opinii">{{$send->content}}</textarea>                                                                                                                                                                                 
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
                                                <div class="modal fade" id="deletePopUp{{$send->id}}" name="{{$send->id}}" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="deletePopUpTitle{{$send->id}}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deletePopUpTitle{{$send->id}}">{{__('Usuwanie opinii')}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form class="form mb-0 text-center" id="{{$send->id}}" name="{{$send->id}}" action="{{route('deleteOpinion', $send)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-body bg-warning">
                                                                    <p>{{__('Czy jesteś pewien, że chcesz usunąć opinię?')}}</p>
                                                                    <p>{{__('Po usunięciu opinii tego działania nie da się cofnąć')}}</p>
                                                                    <p>{{__('Usuwająć opinię tracisz również możliwość jej ponownego dodania')}}</p>
                                                                    <p>{{__('Chcąc edytować swoją opinię użyj opcji "Edytuj" zamiast "Usuń"')}}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" id="buttonSend" class="btn btn-outline-danger">{{__('Usuń')}}</button>
                                                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{__('Anuluj')}}</button>
                                                                </div>                                       
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-center mb-0">{{__('Na razie nie wysłałeś żadnych opinii')}}</p>                                 
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            {{__('Na razie nie masz żadnych opinii')}}
                        </div>                       
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection