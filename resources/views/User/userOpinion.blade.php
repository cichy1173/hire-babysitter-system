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
                                                            <a class="btn btn-sm btn-warning d-inlnie" href="">{{__('Edytuj')}}</a>
                                                            <button class="btn btn-sm btn-danger d-inlnie">{{__('Usuń')}}</button>
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