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
        $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        let messages = {!! json_encode($messages, JSON_HEX_TAG) !!};

        let conversationDiv = $('#converwsationDiv');

        let conversation; 

        messages.forEach(element => {
            if(element['otherUser_id'] == $(button).val())
            {
                conversation = element;
                if(element['lastMessage'].read == 0)
                {
                    $(button).text(element['otherUser_name'] + ' ' + element['otherUser_surname']);
                    $('#'+element['otherUser_id']).html(element['lastMessage_user'] + ': ' + element['lastMessage'].content);
                }
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
                    if(element['read'] == 0)
                    {
                        $.ajax({
                            url: '/messages/markread/'+element['id'],
                            method: "POST"
                        });
                    }

                    if(element['photo'] != null)
                    {
                        htmlToShow +=   '<div class="row mb-3" id="'+element['from_id_user']+'">\
                                        <div class="col">\
                                            <div class="card list-group-item-success" style="max-width: 15rem">\
                                                <a href="{{asset("/")}}'+element['photo']+'" target="_blank">\
                                                    <img class="card-img-top" src="{{asset("/")}}'+element['photo']+'" alt="Message photo">\
                                                </a>\
                                                <div class="card-body">\
                                                    <p class="fs-6">\
                                                        '+element['content']+'\
                                                    </p>\
                                                </div>\
                                                <div class="card-footer text-muted">\
                                                    '+element['created_at']+'\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>';
                    }
                    else
                    {
                        htmlToShow +=   '<div class="row mb-3" id="'+element['from_id_user']+'">\
                                        <div class="col">\
                                            <div class="card list-group-item-success" style="max-width: 15rem">\
                                                <div class="card-body">\
                                                    <p class="fs-6">\
                                                        '+element['content']+'\
                                                    </p>\
                                                </div>\
                                                <div class="card-footer text-muted">\
                                                    '+element['created_at']+'\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>';
                    }
                    

                }
                else
                {
                    if(element['read'] == 1)
                    {
                        if(element['photo'] != null)
                        {
                            htmlToShow +=   '<div class="row mb-3" id="'+element['from_id_user']+'">\
                                        <div class="col">\
                                            <div class="card float-right" style="max-width: 15rem">\
                                                <a href="{{asset("/")}}'+element['photo']+'" target="_blank">\
                                                    <img class="card-img-top" src="{{asset("/")}}'+element['photo']+'" alt="Message photo">\
                                                </a>\
                                                <div class="card-body">\
                                                    <p class="fs-6">\
                                                        '+element['content']+'\
                                                    </p>\
                                                    <div class="float-right">\
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">\
  <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>\
  <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>\
</svg>\
                                                    </div>\
                                                </div>\
                                                <div class="card-footer text-muted">\
                                                    '+element['created_at']+'\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>';
                        }
                        else
                        {
                            htmlToShow +=   '<div class="row mb-3" id="'+element['from_id_user']+'">\
                                        <div class="col">\
                                            <div class="card float-right" style="max-width: 15rem">\
                                                <div class="card-body">\
                                                    <p class="fs-6">\
                                                        '+element['content']+'\
                                                    </p>\
                                                    <div class="float-right">\
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">\
  <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>\
  <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>\
</svg>\
                                                    </div>\
                                                </div>\
                                                <div class="card-footer text-muted">\
                                                    '+element['created_at']+'\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>';
                        }
                    }
                    else
                    {
                        if(element['photo'] != null)
                        {
                            htmlToShow +=   '<div class="row mb-3" id="'+element['from_id_user']+'">\
                                        <div class="col">\
                                            <div class="card float-right" style="max-width: 15rem">\
                                                <a href="{{asset("/")}}'+element['photo']+'" target="_blank">\
                                                    <img class="card-img-top" src="{{asset("/")}}'+element['photo']+'" alt="Message photo">\
                                                </a>\
                                                <div class="card-body">\
                                                    <p class="fs-6">\
                                                        '+element['content']+'\
                                                    </p>\
                                                </div>\
                                                <div class="card-footer text-muted">\
                                                    '+element['created_at']+'\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>';
                        }
                        else
                        {
                            htmlToShow +=   '<div class="row mb-3" id="'+element['from_id_user']+'">\
                                        <div class="col">\
                                            <div class="card float-right" style="max-width: 15rem">\
                                                <div class="card-body">\
                                                    <p class="fs-6">\
                                                        '+element['content']+'\
                                                    </p>\
                                                </div>\
                                                <div class="card-footer text-muted">\
                                                    '+element['created_at']+'\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>';
                        }
                    }
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
                    @error('userTo')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{$message}}</strong>
                        </div>
                    @enderror
                    @error('userMessage')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{$message}}</strong>
                        </div>
                    @enderror
                    @error('photo')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{$message}}</strong>
                        </div>
                    @enderror
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

                                            <div style="max-height: 34rem; overflow-y: auto; overflow-x: hidden;">
                                                @if (count($messages) > 0)
                                                    @foreach ($messages as $message)
                                                        {{-- {{dd($message)}} --}}
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <button class="btn btn-link m-0 p-0" type="button" value="{{$message['otherUser_id']}}" onclick="getConversation(this)">
                                                                            @if ($message['lastMessage']->read == 1)
                                                                                {{$message['otherUser_name']}} {{$message['otherUser_surname']}}
                                                                            @else
                                                                                <strong>{{$message['otherUser_name']}} {{$message['otherUser_surname']}}</strong>
                                                                            @endif                                                                            
                                                                        </button>
                                                                    </div>
                                                                    <div class="card-body" id="{{$message['otherUser_id']}}" style="max-height: 6rem; overflow-y: hidden;">
                                                                        @if ($message['lastMessage']->read == 1)
                                                                            {{$message['lastMessage_user']}}{{__(': ')}}{{$message['lastMessage']->content}}
                                                                        @else
                                                                            <strong>{{$message['lastMessage_user']}}{{__(': ')}}{{$message['lastMessage']->content}}</strong>
                                                                        @endif
                                                                        
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
                                        <div class="card-body scrollingContainer" id="conversationDiv" name="conversationDiv" style="max-height: 34rem; overflow-y: auto; overflow-x: hidden;">
                                            {{__('Wybierz rozmowę z listy lub utwórz nową wiadomość')}}
                                        </div>
                                    </div>
                                    <form class="form mb-0" action="{{route('newMessage', auth()->user())}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" name="userTo" id="userTo" value="-1" hidden>
                                            <div class="input-group">
                                                <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#addFile">{{__('+')}}</button>
                                                <input class="form-control" type="text" id="userMessage" name="userMessage" aria-describedby="buttonSend">
                                                <button class="btn btn-dark" type="submit" id="buttonSend">{{__('Wyślij')}}</button>
                                            </div>
                                        </div> 
                                        <div class="modal fade" id="addFile" tabindex="-1"   role="dialog" aria-labelledby="addFileLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addFileLabel">{{__("Wybierz plik")}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="file" name="photo" accept="image/png, image/jpeg, image/jpg, image/gif" class="form-control-file" id="photo">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{__('Zamknij')}}</button>
                                                    </div>
                                                </div>
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
