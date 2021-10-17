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
                                                <a href="" class="font-weight-bold">{{$advert->title}}</a>
                                                <p class="text-right text-sm text-muted mb-0">{{$advert->updated_at}}</p>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0">lasnidfas</p>
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