@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            @if (session('success'))
            <div class="text-center alert alert-success ">
                {{ session('success') }}    
               
            </div>
            @endif

            <div class="card">
                <div class="card-header text-center">{{ __('Formularz edycji użytkownika użytkownika') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row p-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Imię') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') alert alert-danger is-invalid @enderror" name="name" value="{{ $user->name }}"  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback alert alert-warning " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row p-2">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Nazwisko') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') alert alert-danger is-invalid @enderror" name="surname" value="{{ $user->surname }}"  autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback alert alert-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row p-2">
                            <label for="nickname" class="col-md-4 col-form-label text-md-right">{{ __('Nick') }}</label>

                            <div class="col-md-6">
                                <input id="nickname" type="text" class="form-control @error('nickname') alert alert-danger is-invalid @enderror" name="nickname" value="{{ $user->nickname }}"  autocomplete="surname" autofocus>

                                @error('nickname')
                                    <span class="invalid-feedback alert alert-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row p-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adres e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') alert alert-danger is-invalid @enderror" name="email" value="{{ $user->email }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback alert alert-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row p-2 ">
                            
                            <label class=" col-md-4 col-form-label text-md-right " for="id_account_type">{{ __('Typ konta') }}</label>
                            
                            <div class="col-md-6"> 
                                <select class=" required custom-select form-control" id="id_account_type" name="id_account_type"  autocomplete="id_account_type" >
                                    <option value="1" @if($user->id_account_type == '1') selected @endif>{{ __('Opiekun') }}</option>
                                    <option value="2" @if($user->id_account_type == '2') selected @endif>{{ __('Zwykły użytkownik') }}</option>
                                    <option value="3">{{ __('Administrator') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row p-2 ">
                            
                            <label class=" col-md-4 col-form-label text-md-right " for="about">{{ __('Opis konta') }}</label>
                            
                            <div class="col-md-6"> 
                                <textarea id="about" type="text" class="form-control @error('about')
                                alert alert-danger is-invalid
                                @enderror " name="about"  autofocus>{{ $user->about }}</textarea>        
                            </div>
                        </div>

                        
                      

                        <div class="form-group row p-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Zapisz zmiany') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
