@extends('layouts.app')
@section('content')
@auth
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-success">{{ __('Twoje ogłoszenia') }}</div>
                    <div class="card-body">
                        @if (@isset($adverts))
                            @foreach ($adverts as $advert)
                                <div class="row">
                                    <div class="col">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <p class="font-weight-bold mb-0">{{$advert->title}}</p>
                                                <p class="text-right text-sm text-muted mb-0">{{$advert->created_at->translatedFormat("d M Y G:i")}}</p>
                                            </div>
                                            <div class="card-body ">
                                                <div class="d-inline mb-0 text-muted">{{__('Stawka ')}}</div>
                                                <div class="d-inline mb-0">{{$advert->hour_rate}}</div>
                                                <div class="d-inline mb-0 text-muted">{{__(' zł/h')}}</div>
                                                <div class="float-right mb-0">
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletePopUp">{{__('Usuń')}}</button>
                                                </div>
                                                <div class="modal fade" id="deletePopUp" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="deletePopUpTitle">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deletePopUpTitle">{{__('Czy jesteś pewien, że chcesz usunąć ogłoszenie?')}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>{{__('Usunięcie ogłoszenia wiąże się z jego bezpowrotną utratą.')}}</p>
                                                                <p>{{__('Przywrócenie usuniętego ogłoszenia jest niemożliwe.')}}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Zamknij')}}</button>
                                                                <form class="form-inline float-right mb-0" action="{{route('delete_advert', $advert)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-outline-danger" type="submit" id="button_delete">{{__('Usuń')}}</button>
                                                                </form>
                                                            </div>
                                                        </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endauth
@endsection