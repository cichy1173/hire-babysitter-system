@extends('layouts.app')


@section('content')
@auth
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dodawanie opisu profilu') }}</div>
    
                    <div class="card-body">

                        
                        <form method="POST" action=" {{route('addAbout')}} ">
                           
                            @csrf
                            <div class="form-group">
                                <textarea id="about" placeholder="Tutaj wpisz opis siebie" type="text" class="form-control " name="about"  autofocus>{{ session('about', $about) }}</textarea>            
                            </div>
                             
                                @error('about')
                                    <span class="invalid-feedback alert alert-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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