@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ogłoszenia') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($adverts->count())
                            @foreach ($adverts as $advert)
                                <div class="row">
                                    <div class="col">
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <p class="font-weight-bold mb-0">{{$advert->title}}</p>
                                                <p class="text-right text-sm text-muted mb-0">{{$advert->created_at->format("d M Y G:i")}}</p>
                                            </div>
                                            <div class="card-body ">
                                                <div class="d-inline mb-0 text-muted">{{__('Stawka ')}}</div>
                                                <div class="d-inline mb-0">{{$advert->hour_rate}}</div>
                                                <div class="d-inline mb-0 text-muted">{{__(' zł/h')}}</div>
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
@endsection
