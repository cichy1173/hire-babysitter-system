@extends('layouts.app')


@section('content')

<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Panel administratora') }}</div>
    
                    <div class="card-body">
                        @if (Auth::user()->id_account_type == '3')

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
                                    <td>{{ $user->nickname }}</td>
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