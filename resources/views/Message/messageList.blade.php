@extends('layouts.app')
<script>
    function newMessage()
    {
        let id = $('#select_user').find(":selected").val();
        
        $.ajax({
            url: '/messages/getuser/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){
                console.log(response);
                $('#selectedUser').html(response['data'].name+' '+response['data'].surname);
                $('#userTo').val(id);
            }
        });
    }
</script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Wiadomości') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">{{__('Lista konwersacji')}}</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <button class="btn btn-outline-primary float-right" type="button" data-toggle="modal" data-target="#newMessage">{{__('Nowa wiadomość')}}</button>
                                                </div>
                                            </div>
                                            
                                            @foreach ($messages as $message)
                                                {{-- {{dd($message)}} --}}
                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <div class="card">
                                                            <div class="card-header">{{$message['otherUser_name']}} {{$message['otherUser_surname']}}</div>
                                                            <div class="card-body">
                                                                {{$message['lastMessage']->content}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                            @endforeach
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header" id="selectedUser" name="selectedUser">{{__('Wybierz rozmowę z listy')}}</div>
                                <div class="card-body">
                                    <form class="form mb-0" action="{{route('newMessage', auth()->user())}}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" name="userTo" id="userTo" value="-1" hidden>
                                            <input class="form-control" type="text" id="userMessage" name="userMessage" required>
                                            <button class="btn btn-success" type="submit">{{__('Wyślij')}}</button>
                                        </div>                                        
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
<div class="modal fade" id="newMessage" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">{{__("Wybierz osobę")}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <select class="form-control mb-3" name="select_user" id="select_user">
                @foreach ($users as $item)
                    <option value="{{$item->id}}">{{$item->nickname}}</option>                        
                @endforeach
            </select>
            <button type="button" class="btn btn-primary float-right" data-dismiss="modal" onclick="newMessage()">{{__('Wybierz')}}</button>
        </div>
      </div>
    </div>
  </div>
@endsection
