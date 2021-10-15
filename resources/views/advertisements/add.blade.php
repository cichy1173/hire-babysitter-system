@extends('layouts.app')
@section('content')
@auth
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-success">{{ __('Dodaj ogłoszenie') }}</div>

                    <div class="card-body">
                        <form action="{{ route('add_advert') }}" method="post">
                            @csrf
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="form-control">
                                        <input class="form-check-input" type="radio" onchange="change_add_advert_form(this)" name="advert_type_select" id="advert_type_select_1" checked>
                                        <label class="form-check-label" for="advert_type_select_1">
                                            Szukam opiekunki
                                        </label>
                                    </div>                                    
                                </div>
                                <div class="col">
                                    <div class="form-control">
                                        <input class="form-check-input" type="radio" onchange="change_add_advert_form(this)" name="advert_type_select" id="advert_type_select_2">
                                        <label class="form-check-label" for="advert_type_select_2">
                                            Jestem opiekunką
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="advert_title">Tytuł</span>
                                        <input class="form-control" placeholder="Tytuł ogłoszenia" aria-label="Tytuł" aria-describedby="advert_title" type="text" name="input_advert_title" id="input_advert_title">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="hour_rate">Stawka godzinowa</span>
                                        <input class="form-control" style="text-align: right" placeholder="10" min="0" type="number" name="input_hour_rate" id="input_hour_rate" aria-label="Stawka godzinowa" aria-describedby="hour_rate" value="0">
                                        <span class="input-group-text" id="label_zloty">złotych/godzinę</span>
                                    </div>
                                </div>                                
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="number_of_childs">Liczba dzieci</span>
                                        <input class="form-control" style="text-align: right" type="number" id="input_number_of_childs" min="0" max="10" value="1" aria-label="Liczba dzieci" aria-describedby="number_of_childs">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="min_child_age">Wiek najmłodoszego dziecka</span>
                                        <input class="form-control" style="text-align: right" id="input_min_child_age" onchange="change_child_age()" min="0" max="18" type="number" value="1" aria-label="Najmłodsze dziecko" aria-describedby="min_child_age">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="max_child_number">Wiek najstarszego dziecka</span>
                                        <input class="form-control" style="text-align: right" id="input_max_child_number" type="number" min="0" max="18" value="1" aria-label="Najstarsze dziecko" aria-describedby="max_child_number">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="supervise_from">Opieka od</span>
                                        <input class="form-control" style="text-align: right" type="datetime-local" id="input_supervise_from" aria-label="Opieka od" aria-describedby="supervise_from">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="supervise_to">Opieka do</span>
                                        <input class="form-control" style="text-align: right" type="datetime-local" id="input_supervise_to" aria-label="Opieka do" aria-describedby="supervise_to">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="advert_from">Ogłoszenie od</span>
                                        <input class="form-control" style="text-align: right" type="datetime-local" id="input_advert_from" aria-label="Ogłoszenie od" aria-describedby="advert_from">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="advert_to">Ogłoszenie do</span>
                                        <input class="form-control" style="text-align: right" type="datetime-local" id="input_advert_to" aria-label="Ogłoszenie do" aria-describedby="advert_to">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="country">Kraj</span>
                                        <select class="form-control" id="input_country" aria-describedby="country">
                                            <option value="1">Kluski</option>
                                            <option value="2">Kluski2</option>
                                            <option value="3">Kluski3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="voivodeship">Województwo</span>
                                        <select class="form-control" id="input_voivodeship" aria-describedby="voivodeship" disabled>
                                            <option value="1">Kluski</option>
                                            <option value="2">Kluski2</option>
                                            <option value="3">Kluski3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="city">Miasto</span>
                                        <select class="form-control" id="input_city" aria-describedby="city" disabled>
                                            <option value="1">Kluski</option>
                                            <option value="2">Kluski2</option>
                                            <option value="3">Kluski3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="district">Dzielnica</span>
                                        <select class="form-control" id="input_district" aria-describedby="district" disabled>
                                            <option value="1">Kluski</option>
                                            <option value="2">Kluski2</option>
                                            <option value="3">Kluski3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <span class="input-group-text" id="advert_content">Treść ogłoszenia</span>
                                    <textarea class="form-control" id="input_advert_content" cols="30" rows="10" aria-label="Treść ogłoszenia" aria-describedby="advert_content"></textarea>                                   
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="form-group float-right">
                                        <button class="btn btn-outline-danger" type="reset" id="button_reset">Wyczyść</button>
                                        <button class="btn btn-outline-success" type="submit" id="button_submit">Prześlij</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
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
@endauth
@endsection
