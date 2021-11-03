@extends('layouts.app')


@section('content')
@auth
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card">
                    <div class="card-header">{{ __('Ustawianie zdjęcia profilowego') }}</div>
                   
                    <div class="card-body">
                        <img class="card-img" src="{{asset(Auth::user()->photo)}}" alt="User image">
                       
                        <form method="POST" action=" {{route('storePhoto')}} " enctype="multipart/form-data">
                           
                            @csrf
                            <div class="form-group alert alert-primary">
                                    
                                    <input type="file" name="photo" accept="image/png, image/jpeg, image/jpg, image/gif" class="form-control-file" id="photo">
                                  
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