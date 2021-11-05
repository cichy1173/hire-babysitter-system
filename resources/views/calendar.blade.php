@extends('layouts.app')

@section('content')
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <div class="card">
                    <div class="card-header" align="center" vlign="middle">{{ __('Grafik') }}</div>
    
                    <div class="card-body">
                        @auth (session('status'))
                         <div class="">      
                        <table class="table table-bordered " style="width:100%;table-layout:fixed;">
                            <thead align="center" vlign="middle">
                                <tr class="table-primary">
                                
                                    
                                    <td align="center" vlign="middle" > <button type="button" class="btn btn-primary"><</button></td>
                                    <th  colspan="5">{{now()->translatedFormat('F')}}</th>
                                    <td align="center" vlign="middle" > <button type="button" class="btn btn-primary">></button> </td>
                                    
                                </tr>

                            </thead>
                            <tbody align="center" vlign="middle">
                                <tr class="">
                                    <td align="center" vlign="middle" > <button type="button" class="btn btn-secondary"><</button></td>
                                    <td align="center" vlign="middle" colspan="5"> Data tygodnia </td>
                                    <td align="center" vlign="middle" > <button type="button" class="btn btn-secondary">></button> </td>
                                </tr> 
                                <tr class="table-primary">
                                    <td align="center" vlign="middle"> Poniedziałek </td>
                                    <td align="center" vlign="middle"> Wtorek</td>
                                    <td align="center" vlign="middle"> Środa</td>
                                    <td align="center" vlign="middle"> Czwartek</td>
                                    <td align="center" vlign="middle"> Piątek</td>
                                    <td align="center" vlign="middle"> Sobota</td>
                                    <td align="center" vlign="middle"> Niedziela</td>
                                </tr>
                                <tr class="" >
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                                <tr class="" >
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                </tr>
                                <tr class="" >
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                </tr>
                                <tr class="" >
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                </tr>
                                <tr class="" >
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                </tr>
                                <tr class="" >
                                    <td ></td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                </tr>
                                <tr class="" >
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                </tr>
                                <tr class="" >
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                </tr>
                                <tr class="" >
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                </tr>
                                <tr class="" >
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                </tr>
                                <tr class="" >
                                    <td ></td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                    <td > </td>
                                </tr>
                            </tbody>
                        </table>
                         </div>

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