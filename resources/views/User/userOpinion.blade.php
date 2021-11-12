@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Opinie') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (isset($opinions) && count($opinions) > 0)
                        @foreach ($opinions as $item)
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">                                            
                                            <div class="d-inline mb-0">
                                                <p class="d-inline float-left mx-auto mb-0">
                                                    {{__('Opublikował ')}}
                                                    <a href="{{route('showUser', $item['user'])}}">{{$item['user']->nickname}}</a>
                                                </p>                                             
                                                <p class="d-inline mx-auto float-right mb-0">
                                                    {{$item['opinion']->created_at->translatedFormat('d F Y')}}
                                                </p>  
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <p class="d-inline mx-auto mb-0 text-muted">
                                                    {{__('Ocena ')}}
                                                </p>
                                                <div class="d-inline mx-auto mb-0">
                                                    @for ($i = 0; $i < $item['opinion']->grade; $i++)
                                                        <span class="fa fa-star star-checked"></span>
                                                    @endfor
                                                    @for ($i = $item['opinion']->grade; $i < 5; $i++)
                                                    <span class="fa fa-star"></span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class=" text-justify mb-0">{{$item['opinion']->content}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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