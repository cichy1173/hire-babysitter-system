@extends('layouts.app')


@section('content')
@auth
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card">
                    <div class="card-header">{{ __('Zmiana typu konta') }}</div>
                   
                    <div class="card-body">
                        <div  class="alert alert-info" role="alert">
                        {{__('Twój aktualny typ konta to:  ') }}   
                        <strong> @if (Auth::user()->id_account_type == '1')
                                    {{__('Opiekun')}}
                                @elseif (Auth::user()->id_account_type == '2')
                                    {{__('Zwykły użytkownik')}}   
                                @endif</strong>
                        </div> 
                        <form method="POST" action=" {{route('storeAccountType')}} ">
                           
                            @csrf
                            <div class="form-group">
                                    
                                    <div class="col"> 
                                    <select class=" required custom-select form-control" id="id_account_type" name="id_account_type"  autocomplete="id_account_type" >
                                      <option value="1">{{ __('Opiekun') }}</option>
                                      <option value="2">{{ __('Zwykły użytkownik') }}</option>
                                    </select>

                                     
                                @error('id_account_type')
                                    <span class="invalid-feedback alert alert-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                  
                                
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