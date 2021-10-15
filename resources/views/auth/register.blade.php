@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

         @if (session('registered'))
                    <div class="text-center alert alert-success">
                        {{ session('registered') }}  
                    
                    </div>

                @endif
            <div class="card">
                <div class="card-header">{{ __('Formularz rejestracji konta') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row p-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Imię') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') alert alert-danger is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

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
                                <input id="surname" type="text" class="form-control @error('surname') alert alert-danger is-invalid @enderror" name="surname" value="{{ old('surname') }}"  autocomplete="surname" autofocus>

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
                                <input id="nickname" type="text" class="form-control @error('nickname') alert alert-danger is-invalid @enderror" name="nickname" value="{{ old('nickname') }}"  autocomplete="surname" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') alert alert-danger is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback alert alert-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row p-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') alert alert-danger is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback alert alert-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row p-2">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Powtórz hasło') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row p-2">
                            <label for="id_account_type" class="col-md-4 col-form-label text-md-right">{{ __('Typ konta') }}</label>

                            <div class="col-md-6">
                                <input id="id_account_type" type="text" class="form-control @error('id_account_type') alert alert-danger is-invalid @enderror" name="id_account_type" value="{{ old('id_account_type') }}"  autocomplete="id_account_type" autofocus>

                                @error('id_account_type')
                                    <span class="invalid-feedback alert alert-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      

                        <div class="form-group row p-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Zarejestruj się') }}
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
