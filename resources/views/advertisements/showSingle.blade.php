@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (@isset($advert))
                    <div class="card-header border-success">                        
                        <p class="font-weight-bold mb-0">{{$advert->title}}</p>
                        <p class="text-right text-sm text-muted mb-0">{{$advert->updated_at->format("d M Y G:i")}}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="card mb-3">
                                    <div class="card-body ">
                                        <div class="d-inline mb-0 text-muted">{{__('Stawka ')}}</div>
                                        <div class="d-inline mb-0">{{$advert->hour_rate}}</div>
                                        <div class="d-inline mb-0 text-muted">{{__(' zł/h')}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>                         
                    </div>
                @else
                    <p class="text-center">{{__('Nie masz żadnych ogłoszeń')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection