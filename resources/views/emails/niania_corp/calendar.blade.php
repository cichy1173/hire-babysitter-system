@component('mail::message')
# Twój Grafik: <br>

@component('mail::table', ['class' => 'my-table'])
    |Użytkownik|Początek|Koniec|Stawka|Lokalizacja|Liczba dzieci|
    | :-------------: | :---------: | :---------: | :----: | :---------: | :------------: |
    @foreach ($cals as $cal)
    | {{$cal->nickname}} | {{\Carbon\Carbon::parse($cal->time_from)->translatedFormat('d F Y H:i') }} | {{\Carbon\Carbon::parse($cal->time_to)->translatedFormat('d F Y H:i')}} | {{$cal->hour_rate}} zł/h | {{$cal->district_name}} | {{$cal->child_num}} |
    @endforeach

@endcomponent




<br>**Dziękujemy za zaufanie,**<br>
{{ config('app.name') }}
@endcomponent