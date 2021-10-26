@extends('layouts.app')
@section('content')
@auth
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-success">{{ __('Twoje ogłoszenia') }}</div>
                    <div class="card-body">
                        @if ($adverts->count())
                            @foreach ($adverts as $advert)
                                <div class="row">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-header">
                                                <p class="font-weight-bold mb-0">{{$advert->title}}</p>
                                                <p class="text-right text-sm text-muted mb-0">{{$advert->updated_at->format("d M Y G:i")}}</p>
                                            </div>
                                            <div class="card-body ">
                                                <div class="d-inline mb-0 text-muted">{{__('Stawka ')}}</div>
                                                <div class="d-inline mb-0">{{$advert->hour_rate}}</div>
                                                <div class="d-inline mb-0 text-muted">{{__(' zł/h')}}</div>
                                                <form class="form-inline float-right mb-0" action="{{route('delete_advert', $advert)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="form-group float-right mb-0">
                                                        <button class="btn btn-sm btn-outline-danger" type="submit" id="button_delete">Usuń</button>
                                                    </div>
                                                </form>
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