@extends('layouts.app')
<script>
    function newMessage()
    {
        let id = $('#select_user').find(":selected").val();

        $('#conversationDiv').html('');
        
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

    function getConversation(button)
    {
        let messages = {!! json_encode($messages, JSON_HEX_TAG) !!};

        let conversationDiv = $('#converwsationDiv');

        let conversation; 

        messages.forEach(element => {
            if(element['otherUser_id'] == $(button).val())
            {
                conversation = element;
            }
        });

        $('#selectedUser').html(conversation['otherUser_name']+' '+conversation['otherUser_surname']);
        $('#userTo').val(conversation['otherUser_id']);

        conversation = Object.entries(conversation);

        let htmlToShow = '';

        conversation.forEach(([index, element]) => {
            if($.isNumeric(index))
            {
                if(element['from_id_user'] == $(button).val())
                {
                    htmlToShow +=   '<div class="card mb-3 list-group-item-success" style="width: 18rem">\
                                        <div class="card-body">\
                                            <p class="fs-6">\
                                                '+element['content']+'\
                                            </p> \
                                        </div>\
                                        <div class="card-footer text-muted">\
                                            '+element['created_at']+'\
                                        </div>\
                                    </div>';
                }
                else
                {
                    htmlToShow +=   '<div class="card mb-3 float-right" style="width: 18rem">\
                                        <div class="card-body">\
                                            <p class="fs-6">\
                                                '+element['content']+'\
                                            </p> \
                                        </div>\
                                        <div class="card-footer text-muted">\
                                            '+element['created_at']+'\
                                        </div>\
                                    </div>';
                }
            }
        });

        $('#conversationDiv').html(htmlToShow);

        var myDiv = document.getElementById("conversationDiv");
        myDiv.scrollTop = myDiv.scrollHeight;     

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
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">{{__('Lista konwersacji')}}</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <button class="btn btn-primary btn-lg btn-block" type="button" data-toggle="modal" data-target="#newMessage">{{__('Nowa konwersacja')}}</button>
                                                </div>
                                            </div>

                                            <div style="max-height: 30rem; overflow-y: auto; overflow-x: hidden;">
                                                @if (count($messages) > 0)
                                                    @foreach ($messages as $message)
                                                        {{-- {{dd($message)}} --}}
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <button class="btn btn-link m-0 p-0" type="button" value="{{$message['otherUser_id']}}" onclick="getConversation(this)">{{$message['otherUser_name']}} {{$message['otherUser_surname']}}</button>
                                                                    </div>
                                                                    <div class="card-body" style="max-height: 6rem; overflow-y: hidden;">
                                                                        {{$message['lastMessage']->content}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                
                                                    @endforeach
                                                @else
                                                    <div class="row mb-3">
                                                        <div class="col">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    {{__('Brak aktywnych konwersacji')}}
                                                                </div>
                                                                <div class="card-body" style="max-height: 6rem; overflow-y: hidden;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                @endif                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header" id="selectedUser" name="selectedUser">{{__('Wybierz rozmowę z listy')}}</div>
                                <div class="card-body">
                                    <div class="card mb-3">
                                        <div class="card-body scrollingContainer" id="conversationDiv" name="conversationDiv" style="max-height: 30rem; overflow-y: auto; overflow-x: hidden;">
                                            {{__('Wybierz rozmowę z listy lub utwórz nową wiadomość')}}
                                        </div>
                                    </div>
                                    <form class="form mb-0" action="{{route('newMessage', auth()->user())}}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" name="userTo" id="userTo" value="-1" hidden>
                                            <div class="input-group">
                                                <input class="form-control" type="text" id="userMessage" name="userMessage" required aria-describedby="buttonSend">
                                                <button class="btn btn-dark" type="submit" id="buttonSend">{{__('Wyślij')}}</button>
                                            </div>                                            
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
