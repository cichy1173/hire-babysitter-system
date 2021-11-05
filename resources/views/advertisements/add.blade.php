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
                                        <input class="form-check-input" type="radio" onchange="change_add_advert_form(this)" name="advert_type_select" id="advert_type_select_1" value="1" checked>
                                        <label class="form-check-label" for="advert_type_select_1">
                                            Szukam opiekunki
                                        </label>
                                        @error('advert_type_select')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>                                    
                                </div>
                                <div class="col">
                                    <div class="form-control">
                                        <input class="form-check-input @error('advert_type_select') alert alert-danger is-invalid @enderror" type="radio" onchange="change_add_advert_form(this)" name="advert_type_select" id="advert_type_select_2" value="2">
                                        <label class="form-check-label" for="advert_type_select_2">
                                            Jestem opiekunką
                                        </label>
                                        @error('advert_type_select')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="advert_title">Tytuł</span>
                                        <input class="form-control @error('input_advert_title') alert alert-danger is-invalid @enderror" placeholder="Tytuł ogłoszenia" aria-label="Tytuł" aria-describedby="advert_title" type="text" name="input_advert_title" id="input_advert_title" value="{{ old('input_advert_title') }}">
                                        @error('input_advert_title')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="hour_rate">Stawka godzinowa</span>
                                        <input class="form-control @error('input_hour_rate') alert alert-danger is-invalid @enderror" style="text-align: right" min="0" type="number" name="input_hour_rate" id="input_hour_rate" aria-label="Stawka godzinowa" aria-describedby="hour_rate" value="{{ old('input_hour_rate') }}">
                                        <span class="input-group-text" id="label_zloty">złotych/godzinę</span>
                                        @error('input_hour_rate')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>                                
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="number_of_childs">Liczba dzieci</span>
                                        <input class="form-control @error('input_number_of_childs') alert alert-danger is-invalid @enderror" style="text-align: right" type="number" name="input_number_of_childs" id="input_number_of_childs" min="0" max="10" value="{{ old('input_number_of_childs') }}" aria-label="Liczba dzieci" aria-describedby="number_of_childs">
                                        @error('input_number_of_childs')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="min_child_age">Wiek najmłodoszego dziecka</span>
                                        <input class="form-control @error('input_min_child_age') alert alert-danger is-invalid @enderror" style="text-align: right" name="input_min_child_age" id="input_min_child_age" onchange="change_child_age()" min="0" max="18" type="number" value="{{ old('input_min_child_age') }}" aria-label="Najmłodsze dziecko" aria-describedby="min_child_age">
                                        @error('input_min_child_age')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="max_child_number">Wiek najstarszego dziecka</span>
                                        <input class="form-control @error('input_max_child_age') alert alert-danger is-invalid @enderror" style="text-align: right" name="input_max_child_age" id="input_max_child_age" type="number" min="0" max="18" value="{{ old('input_max_child_age') }}" aria-label="Najstarsze dziecko" aria-describedby="max_child_number">
                                        @error('input_max_child_age')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="supervise_from">Opieka od</span>
                                        <input class="form-control @error('input_supervise_from') alert alert-danger is-invalid @enderror" style="text-align: right" type="datetime-local" name="input_supervise_from" id="input_supervise_from" aria-label="Opieka od" aria-describedby="supervise_from" value="{{old('input_supervise_from')}}">
                                        @error('input_supervise_from')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="supervise_to">Opieka do</span>
                                        <input class="form-control @error('input_supervise_to') alert alert-danger is-invalid @enderror" style="text-align: right" type="datetime-local" name="input_supervise_to" id="input_supervise_to" aria-label="Opieka do" aria-describedby="supervise_to" value="{{old('input_supervise_to')}}">
                                        @error('input_supervise_to')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="advert_from">Ogłoszenie od</span>
                                        <input class="form-control @error('input_advert_from') alert alert-danger is-invalid @enderror" style="text-align: right" type="datetime-local" name="input_advert_from" id="input_advert_from" aria-label="Ogłoszenie od" aria-describedby="advert_from" value="{{old('input_advert_from')}}">
                                        @error('input_advert_from')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="advert_to">Ogłoszenie do</span>
                                        <input class="form-control @error('input_advert_to') alert alert-danger is-invalid @enderror" style="text-align: right" type="datetime-local" name="input_advert_to" id="input_advert_to" aria-label="Ogłoszenie do" aria-describedby="advert_to" value="{{old('input_advert_to')}}">
                                        @error('input_advert_to')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="country">Kraj</span>
                                        <select class="form-control @error('input_country') alert alert-danger is-invalid @enderror" onclick="selectVoivodeship()" name="input_country" id="input_country" aria-describedby="country">
                                            @isset($countries)
                                                @foreach ($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                                                @endforeach
                                            @endisset                                            
                                        </select>
                                        @error('input_country')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="voivodeship">Województwo</span>
                                        <select class="form-control @error('input_voivodeship') alert alert-danger is-invalid @enderror" onclick="selectCity()" name="input_voivodeship" id="input_voivodeship" aria-describedby="voivodeship">
                                            <option value="-1">{{__('Brak danych')}}</option>
                                        </select>
                                        @error('input_voivodeship')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="city">Miasto</span>
                                        <select class="form-control @error('input_city') alert alert-danger is-invalid @enderror" onclick="selectDistrict()" name="input_city" id="input_city" aria-describedby="city">
                                            <option value="-1">{{__('Brak danych')}}</option>
                                        </select>
                                        @error('input_city')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-text" id="district">Dzielnica</span>
                                        <select class="form-control @error('input_district') alert alert-danger is-invalid @enderror" name="input_district" id="input_district" aria-describedby="district">
                                            <option value="-1">{{__('Brak danych')}}</option>
                                        </select>
                                        @error('input_district')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <span class="input-group-text" id="skills">Umiejętności</span>
                                    <select class="form-control @error('input_skill') alert alert-danger is-invalid @enderror" name="input_skill[]" id="input_skill" multiple size="5">
                                        @isset($skills)
                                            @foreach ($skills as $item)
                                                <option value="{{$item->id}}">{{$item->skill_name}}</option>
                                            @endforeach
                                        @endisset                                        
                                    </select>
                                    @error('input_skill')
                                        <span class="invalid-feedback alert alert-warning" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col">
                                    <span class="input-group-text" id="advert_content">Treść ogłoszenia</span>
                                    <textarea class="form-control @error('input_advert_content') alert alert-danger is-invalid @enderror" name="input_advert_content" id="input_advert_content" cols="30" rows="10" aria-label="Treść ogłoszenia" aria-describedby="advert_content">{{old('input_advert_content')}}</textarea> 
                                    @error('input_advert_content')
                                            <span class="invalid-feedback alert alert-warning " role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
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
