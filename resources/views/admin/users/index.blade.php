@extends('layouts.app')


@section('content')

<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Panel administratora') }}</div>
    
                    <div class="card-body">
                        @admin

                        @if (session('success'))
                        <div class="text-center alert alert-success ">
                            {{ session('success') }}    
                           
                        </div>
                        @endif

                        <div class="float-right mb-2 px-2"> 
                            <a class="btn btn-info float-right" href="{{ route('admin.users.create') }}"
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
                                    <td><button type="button" class="btn btn-sm btn-link" data-toggle="modal" data-target="#showUserinfo-{{ $user->id }}" >{{ $user->nickname }}</button></td>

                                    <div class="modal fade" id="showUserinfo-{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="showUserinfo">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title font-weight-bold" id="showUserinfo-{{ $user->id }}">{{__('Dane użytkownika ')}} {{$user->nickname}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($user->id_account_type == '3')
                                                    <div class="alert alert-info text-center" role="alert">
                                                        Ten użytkownik jest administratorem
                                                      </div>
                                                    @endif

                                                    @if ($user->is_blocked == '1')
                                                    <div class="alert alert-warning text-center" role="alert">
                                                        Ten użytkownik jest zablokowany
                                                      </div>

                                                      @elseif ($user->is_blocked == '0')
                                                      <div class="alert alert-success text-center" role="alert">
                                                        Ten użytkownik jest odblokowany
                                                      </div>
                                                    @endif
                                                  
                                                    <p><b>Imię:</b> {{ $user->name }}</p>
                                                    <p><b>Nazwisko:</b> {{ $user->surname }}</p>
                                                    <p><b>Nazwa użytkownika:</b> {{ $user->nickname }}</p>
                                                    <p><b>Adres e-mail:</b> {{ $user->email }}</p>
                                                    <p><b>Typ konta:</b> @if ( $user->id_account_type == '1' ) Opiekun 
                                                        @elseif ($user->id_account_type == '2') Zwykły użytkownik 
                                                        @elseif ($user->id_account_type == '3') Administrator</p> @endif
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Zamknij')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->id_account_type != '3')  <a class="btn btn-sm btn-primary m-1" href="{{ route('admin.users.edit', $user->id) }}"
                                        role="button">Edytuj</a> @else
                                        <button type="button" class="btn btn-sm btn-secondary m-1" disabled>Edytuj</button> @endif


                                        @if ($user->id_account_type != '3')
                                        <button type="button" class="btn btn-sm btn-success m-1"
                                        onclick="event.preventDefault();  document.getElementById('makeadmin-user-form-{{ $user->id }}').submit() " >
                                           Mianuj administratorem
                                       </button> 
 
                                       <form id="makeadmin-user-form-{{ $user->id }}" action="{{ route('admin.users.makeadmin', $user->id) }}" method="POST" style="display: none">
                                           @csrf
                                           @method('PUT')
                                       </form>

                                       @else
                                       <button type="button" class="btn btn-sm btn-secondary m-1" disabled>Mianuj administratorem</button> 
                                       @endif


                                        @if ($user->id_account_type != '3')

                                        @if ($user->is_blocked == 0)

                                        <button type="button" class="btn btn-sm btn-warning m-1"
                                        onclick="event.preventDefault();  document.getElementById('block-user-form-{{ $user->id }}').submit() " >
                                           Zablokuj
                                       </button> 

                                       <form id="block-user-form-{{ $user->id }}" action="{{ route('admin.users.block', $user->id) }}" method="POST" style="display: none">
                                        
                                           @csrf
                                       </form>

                                       @else
                                       <button type="button" class="btn btn-sm btn-success m-1"
                                       onclick="event.preventDefault();  document.getElementById('unblock-user-form-{{ $user->id }}').submit() " >
                                          Odblokuj
                                      </button> 

                                      <form id="unblock-user-form-{{ $user->id }}" action="{{ route('admin.users.unblock', $user->id) }}" method="POST" style="display: none">
                                          @csrf
                                          @method('PUT')
                                      </form>
                                      @endif


                                      @else
                                      <button type="button" class="btn btn-sm btn-secondary m-1" disabled>Zablokuj</button>
                                            
                                            
                                        @endif



                                        @if($user->id_account_type != '3')

                                  

                                        <button type="button" class="btn btn-sm btn-danger m-1"
                                         onclick="event.preventDefault();  document.getElementById('delete-user-form-{{ $user->id }}').submit() " >
                                            Usuń
                                        </button> 

                                        <form id="delete-user-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        @else
                                        <button type="button" class="btn btn-sm btn-secondary m-1" disabled>Usuń</button>

                                        @endif


                                    </td>
                                  </tr> 
                                @endforeach
                              
                            </tbody>
                          </table>

                          <div class="float-right">
                            {{ $users->links() }}
                          </div>


                        @endadmin

                       
                       
                       
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