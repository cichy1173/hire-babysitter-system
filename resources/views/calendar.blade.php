@extends('layouts.app')
<?php
    $a=0;    
    if(array_key_exists('button1', $_POST)) {
            button1();
        }
    else if(array_key_exists('button2', $_POST)) {
            button2();
        }
        function button1() {
            return $a--;
        }
        function button2() {
            return $a++;
        }
    
?> 
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
                            <thead class="table table-borderless" align="center" vlign="middle">
                                <tr class="table-primary">   
                                                                    
                                    <th  colspan="7">{{ucfirst(trans(now()->addWeek("$a")->translatedFormat('F')))}}</th>
                                                                        
                                </tr>
                                
                                <tr class="tabel-light">
                                    <td align="center" vlign="middle" > <input type="submit" class="btn btn-secondary" name="button1" class="button" value="<" onclick=";window.location.reload();" /></td>
                                    <td align="center" vlign="middle" colspan="5">{{now()->addWeek("$a")->startOfWeek()->translatedFormat('d-m-Y')}} -/- {{now()->addWeek("$a")->endOfWeek()->translatedFormat('d-m-Y')}} </td>
                                    <td align="center" vlign="middle" > <input type="submit" class="btn btn-secondary" name="button2" class="button" value="<" onclick="window.location.reload();" /> </td>
                                </tr> 

                            </thead>
                            <tbody   align="center" vlign="middle">
                                
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