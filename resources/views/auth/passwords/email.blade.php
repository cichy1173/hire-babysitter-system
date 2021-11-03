@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Przywracanie hasła') }}</div>

             @if (session('stat'))
                <div class="text-center alert alert-info">
                    {{ __('Po kliknięciu na poniższy przycisk zostanie wysłana wiadomość e-mail z linkiem do zmiany hasła.') }}  
                
                </div>

            @endif


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf



                        <div class="form-group row p-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Wpisz swój adres e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" @if (session('stat')) value="{{ session('stat') }}" readonly @endif type="email" class="form-control @error('email') alert alert-danger is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback alert alert-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row p-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Zresetuj hasło') }}
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
