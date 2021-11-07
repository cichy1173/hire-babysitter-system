@extends('layouts.app')
@section('content')
@auth
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-success">
                        {{ __('Twoje ogłoszenia') }}
                        @if (session('status'))
                            <script>
                                $(window).on('load', function() {
                                    $('#exampleModal').modal('show');
                                });
                            </script>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                    <h5 class="modal-title" id="exampleModalLabel">{{__('Ogłoszenie edytowane pomyślnie')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <p>{{__('Ogłoszenie zostało zapisane i jest już dostępne w zmienionej formie')}}</p>
                                    </div>
                                    <div class="modal-footer">                                    
                                    <a class="btn btn-primary" href="{{route('homePage')}}">{{__('Strona główna')}}</a>
                                    <button type="button" class="btn btn-success" data-dismiss="modal">{{__('OK')}}</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if (@isset($adverts))
                            @foreach ($adverts as $advert)
                                <div class="row">
                                    <div class="col">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <a href="{{route('showSingle', $advert)}}" class="font-weight-bold mb-0">{{$advert->title}}</a>
                                                <p class="text-right text-sm text-muted mb-0">{{$advert->created_at->translatedFormat("d M Y G:i")}}</p>
                                            </div>
                                            <div class="card-body ">
                                                <div class="d-inline mb-0 text-muted">{{__('Stawka ')}}</div>
                                                <div class="d-inline mb-0">{{$advert->hour_rate}}</div>
                                                <div class="d-inline mb-0 text-muted">{{__(' zł/h')}}</div>
                                                <div class="float-right">
                                                    <form class="form" action="{{route('edit_advert', $advert)}}" method="GET">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-warning">{{__('Edytuj')}}</button>    
                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletePopUp">{{__('Usuń')}}</button>
                                                    </form>                                                    
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
                                                                <form class="form float-right mb-0" action="{{route('delete_advert', $advert)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Zamknij')}}</button>
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
                        <div class="d-flex justify-content-end">
                            {{ $adverts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endauth
@endsection