@extends('layouts.app')


@section('content')
@auth
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card">
                    <div class="card-header">{{ __('Zmiana nazwy użytkownika nickname') }}</div>
                   
                    <div class="card-body">
                        <div  class="alert alert-info" role="alert">
                        {{__('Twój aktualny nick to:  ') }}   <strong>{{ Auth::user()->nickname }}</strong>
                        </div> 
                        <form method="POST" action=" {{route('addNickname')}} ">
                           
                            @csrf
                            <div class="form-group">
                                <input id="nickname" type="nickname" class="form-control" value="{{  Auth::user()->nickname }}"  name="nickname" autocomplete="nickname" autofocus>
                             
                                @error('nickname')
                                    <span class="invalid-feedback alert alert-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>

                            <div class="mb-1 row">
                                <div class="col">
                                    <div class="form-group float-right">
                                        
                                        <button class="btn btn-outline-success" type="submit" id="button_submit">{{__("Zapisz")}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>    


                        @endauth
                        
                        @guest
                        <div class="alert alert-info" role="alert">
                            {{ __('Aby zobaczyć więcej, zaloguj się') }}
                        </div>
                        @endguest
    
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection