@extends('layouts.app')
@section('content')
{{-- @auth --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-success">{{ __('Dodaj ogłoszenie') }}</div>

                    <div class="card-body">
                        <form action="{{ route('add_advert') }}" method="post">
                            @csrf
                            <div class="mb-3 mx-2 row">
                                <div class="form-control col mr-3">
                                    <input class="form-check-input" type="radio" onchange="change_add_advert_form(this)" name="advert_type_select" id="advert_type_select_1" checked>
                                    <label class="form-check-label" for="advert_type_select_1">
                                        Szukam opiekunki
                                    </label>
                                </div>
                                <div class="form-control col ml-3">
                                    <input class="form-check-input" type="radio" onchange="change_add_advert_form(this)" name="advert_type_select" id="advert_type_select_2">
                                    <label class="form-check-label" for="advert_type_select_2">
                                        Jestem opiekunką
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3 mx-2 row">
                                <div class="input-group">
                                    <span class="input-group-text" id="advert_title">Tytuł</span>
                                    <input class="form-control" placeholder="Tytuł ogłoszenia" aria-label="Tytuł" aria-describedby="advert_title" type="text" name="input_advert_title" id="input_advert_title">
                                </div>
                            </div>
                            <div class="mb-3 mx-2 row">
                                <div class="input-group">
                                    <span class="input-group-text" id="hour_rate">Stawka godzinowa</span>
                                    <input class="form-control" onchange="change_hour_rate_label(this)" style="text-align: right" placeholder="10" min="0" type="number" name="input_hour_rate" id="input_hour_rate" aria-label="Stawka godzinowa" aria-describedby="hour_rate">
                                    <span class="input-group-text" id="label_zloty">złotych/godzinę</span>
                                </div>                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- @else
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white bg-danger h3">{{ __('Musisz być zalogowany, aby móc dodawać ogłoszenia!') }}</div>

                <div class="card-body">
                    <div class="row m-3">
                        @if (Route::has('login'))
                            <a href=" {{ route('login') }}">{{ __("Zaloguj się")}}</a>
                        @endif
                    </div>
                    <div class="row m-3">
                        @if (Route::has('register'))
                            <a href=" {{ route('register') }}">{{ __("Zarejestruj się")}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth --}}
@endsection
