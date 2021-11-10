@extends('layouts.app')


@section('content')

<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Panel administratora') }}</div>
    
                    <div class="card-body">
                        @if (Auth::user()->id_account_type == '3')

                        <div class="float-right mb-2 px-2"> 
                            <a class="btn btn-outline-success float-right" href="{{ route('admin.users.create') }}"
                                role="button">Dodaj użytkownika</a>
                        </div>
                        
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nazwa użytkownika</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Akcja</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->nickname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                       <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.users.edit', $user->id) }}"
                                        role="button">Edytuj</a>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                         onclick="event.preventDefault(); document.getElementyById('delete-user-form-{{ $user->id }}).submit()')" >
                                            Usuń
                                        </button> 

                                        <form id="delete-user-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none">
                                            @csrf
                                            @method("DELETE")

                                        </form>
                                    </td>
                                  </tr> 
                                @endforeach
                              
                            </tbody>
                          </table>
           


                        @endif

                       
                       
                       
                        @if(Auth::user()->id_account_type == '1' || Auth::user()->id_account_type == '2')

                        <div class="alert alert-info" role="alert">
                            {{ __('Musisz być administratorem, aby zobaczyć tę treść!') }}
                        </div>

                        @endif

                        
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