@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            @if (session('success'))
            <div class="text-center alert alert-success">
                {{ session('success') }}       
            </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Edycja profilu') }}</div>
                <div class="card-body">

                    <div class="list-group p-2">
                        <a href=" # " class="list-group-item list-group-item-action list-group-item-success">Dodaj zdjęcie profilowe</a>
                        <a href=" {{route('showDescriptionBlade')}} " class="list-group-item list-group-item-action list-group-item-success">{{__("Zarządzaj opisem konta")}}</a>

                    </div>
                    
                    <div class="list-group p-2"> 
                        <a href="#" class="list-group-item list-group-item-action list-group-item-info">Zmień typ konta</a> 
                        <a href="#" class="list-group-item list-group-item-action list-group-item-info">Zmień nick</a>

                    </div>    

                         <div class=" p-2"> 
                            <form id="delete_account_form" class="mb-1" action=" {{route('reset_pswd')}} " method="post">
                                @csrf
                                <button type="button" data-toggle="modal" data-target="#changePasswordPopUp"  class="p-2 btn btn-outline-dark btn-lg btn-block font-weight-bold">{{ __('Zmień hasło') }}</button>
                               
                            </form>
                            <div class="modal fade" id="changePasswordPopUp" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="changePasswordPopUp">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="changePasswordPopUp">{{__('Czy jesteś pewien, że chcesz zmienić hasło?')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>{{__('W celu zmiany hasła zostaniesz wylogowany.')}}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Zamknij')}}</button>
                                            <form class="form-inline" action=" {{route('reset_pswd')}} "  method="POST">
                                                @csrf
            
                                                <button class="btn btn btn-info" type="submit" id="button_change">{{__('Zmień hasło')}}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>    

            
                         
                            <form id="delete_account_form" action=" {{route('userEdit')}} " method="post">
                                @csrf
                                
                                <button type="button" data-toggle="modal" data-target="#deleteAccountPopUp" class=" p-2 btn btn-outline-danger btn-lg btn-block font-weight-bold">{{ __('Usuń konto') }}</button>

                            </form>
                        </div>

                        <div class="modal fade" id="deleteAccountPopUp" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="deleteAccountPopUp">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteAccountPopUp">{{__('Czy jesteś pewien, że usunąć konto?')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>{{__('Usunięcie konta jest bezpowrotne.')}}</p>
                                        <p>{{__('Po usunięciu stracisz wszystkie swoje zapisane dane.')}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Zamknij')}}</button>
                                        <form class="form-inline" action=" {{route('userEdit')}} "  method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn btn-danger" type="submit" id="button_delete_account">{{__('Usuń konto')}}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>    




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
