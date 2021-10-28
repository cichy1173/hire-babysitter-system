@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edycja profilu') }}</div>
                <div class="card-body">

                    <div class="list-group p-2">
                        <a href="#" class="list-group-item list-group-item-action list-group-item-success">Dodaj zdjęcie profilowe</a>
                        <a href="#" class="list-group-item list-group-item-action list-group-item-success">Dodaj opis profilu</a>

                    </div>
                    
                    <div class="list-group p-2"> 
                        <a href="#" class="list-group-item list-group-item-action list-group-item-info">Zmień typ konta</a> 
                        <a href="#" class="list-group-item list-group-item-action list-group-item-info">Zmień nick</a>

                    </div>    

                         <div class=" p-2"> 
                            <form id="delete_account_form" class="mb-1" action=" {{route('reset_pswd')}} " method="post">
                                @csrf
                                <button class="p-2 btn btn-outline-warning text-black-50 btn-lg btn-block font-weight-bold">{{ __('Zmień hasło') }}</button>

                            </form>
   

                         
                            <form id="delete_account_form" action=" {{route('userEdit')}} " method="post">
                                @csrf
                                @method('DELETE')
                                <button class=" p-2 btn btn-outline-danger btn-lg btn-block font-weight-bold">{{ __('Usuń konto') }}</button>

                            </form>
                        </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
