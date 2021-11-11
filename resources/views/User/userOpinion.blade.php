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
