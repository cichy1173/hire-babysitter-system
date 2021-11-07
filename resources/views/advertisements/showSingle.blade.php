@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                @if (@isset($advert))
                    <div class="card-header border-success">                       
                        <div class="d-inline font-weight-bold mb-0">{{$advert->title}}</div>
                        <div class="d-inline text-right text-sm text-muted mb-0">{{$advert->updated_at->translatedFormat("d M Y G:i")}}</div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline mb-0 text-muted">{{__('Typ ogłoszenia ')}}</div>
                                        @if ($advert->id_advertisement_type == 1)
                                            <div class="d-inline mb-0">{{__('Szukam opiekuna')}}</div>
                                        @else
                                            <div class="d-inline mb-0">{{__('Jestem opiekunem')}}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">                                        
                                        <form class="form mb-0" method="GET" action="{{route('showUser', $user)}}">
                                            @csrf
                                            <div class="d-inline mb-0 text-muted">{{__('Opublikował ')}}</div>
                                            <button class="btn btn-link btn-sm mb-0 p-0" type="submit">{{$user->nickname}}</button>
                                            <div class="input-group flex-nowrap d-inline">
                                                @for ($i = 0; $i < $user->reputation; $i++)
                                                    <span class="fa fa-star star-checked"></span>
                                                @endfor
                                                @for ($i = $user->reputation; $i < 5; $i++)
                                                <span class="fa fa-star"></span>
                                                @endfor
                                            </div>
                                        </form>
                                                                                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline mb-0 text-muted">{{__('Stawka ')}}</div>
                                        <div class="d-inline mb-0">{{$advert->hour_rate}}</div>
                                        <div class="d-inline mb-0 text-muted">{{__(' zł/h')}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline mb-0 text-muted">{{__('Liczba dzieci ')}}</div>
                                        <div class="d-inline mb-0">{{$advert->child_num}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline mb-0 text-muted">{{__('Wiek najmłodszego dziecka ')}}</div>
                                        <div class="d-inline mb-0">{{$advert->age_min}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline mb-0 text-muted">{{__('Wiek najstarszego dziecka ')}}</div>
                                        <div class="d-inline mb-0">{{$advert->age_max}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline mb-0 text-muted">{{__('Opieka od ')}}</div>
                                        <div class="d-inline mb-0">{{$advert->supervise_from->translatedFormat("d M Y")}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline mb-0 text-muted">{{__('Opieka do ')}}</div>
                                        <div class="d-inline mb-0">{{$advert->supervise_to->translatedFormat("d M Y")}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline mb-0 text-muted">{{__('Miasto ')}}</div>
                                        <div class="d-inline mb-0">{{$city->city_name}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline mb-0 text-muted">{{__('Dzielnica ')}}</div>
                                        <div class="d-inline mb-0">{{$district->district_name}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-1 text-muted">{{__('Umiejętności')}}</div>
                                        <ul class="list-group list-group-flush">
                                            @foreach ($skills as $item)
                                                <li class="list-group-item" data-toggle="tooltip" data-placement="top" title="{{$item->skill_description}}">{{$item->skill_name}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="row mb-3">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-0 text-muted">{{__('Treść ogłoszenia')}}</div>
                                        <p class="card-text text-justify">{{$advert->content}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @auth
                            @if (auth()->id() == $advert->id_user)
                                
                            @else
                                <div class="row">
                                    <div class="col">
                                        <div class="float-right">
                                            <button class="btn btn-outline-primary" type="button" id="button_message" data-toggle="modal" data-target="#sendToUser">{{__('Wyślij wiadomość')}}</button>
                                            <button class="btn btn-outline-success" type="button" id="button_accept">{{__('Zaakceptuj ogłoszenie')}}</button>
                                        </div>
                                    </div>                            
                                </div>

                                <div class="modal fade" id="sendToUser" tabindex="-1" role="dialog" aria-labelledby="senToUserTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="senToUserTitle">{{__('Wyślij wiadomość')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form class="form mb-0" action="{{route('newMessage', auth()->user())}}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="input-group">
                                                        <input type="text" name="userTo" id="userTo" value="{{$advert->id_user}}" hidden>
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
                    <p class="text-center">{{__('Nie ma takiego ogłoszenia')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection