<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class MessageController extends Controller
{
    public function index(User $user)
    {
        if(auth()->user() != $user)
        {
            return redirect()->back();
        }

        $array = [];

        $messagesSend = DB::table('messages')
                    ->where('from_id_user', auth()->id())
                    ->get();
        
        $messagesReceived = DB::table('messages')
                    ->where('to_id_user', auth()->id())
                    ->get();

        $merged = $messagesSend->merge($messagesReceived);

        $merged = $merged->sortByDesc('created_at');

        foreach ($merged as $key => $value) {
            array_push($array, $value->from_id_user);
            array_push($array, $value->to_id_user);
        }

        while (($key = array_search(auth()->id(), $array)) !== false) {
            unset($array[$key]);
        }
        
        $array = array_unique($array);

    

        $messages = [];

        foreach ($array as $key => $value) {
            $msg = DB::table('messages')
                    ->where([
                        ['from_id_user', auth()->id()],
                        ['to_id_user', $value]])
                    ->orWhere([
                        ['to_id_user', auth()->id()],
                        ['from_id_user', $value]])
                    ->orderBy('created_at')
                    ->get();

            $usr = User::find($value);

            $msg->put('lastMessage', $msg->last());
            $msg->put('otherUser_id', $usr['id']);
            $msg->put('otherUser_name', $usr['name']);
            $msg->put('otherUser_surname', $usr['surname']);
            $msg->put('otherUser_nickname', $usr['nickname']);
            $msg->put('otherUser_photo', $usr['photo']);

            array_push($messages, $msg); 
        }

        $users = User::all()->where('id', '!=', auth()->id()) ->sortBy('nickname');
        
        return view('Message.messageList', [
            'messages' => $messages,
            'users' => $users
        ]);
    }


    public function newMessage(Request $request)
    {
        $this->validate($request, [
            'userTo' => 'required|int|exists:users,id',
            'userMessage' => 'required|string|max:2000'
        ]);

        Message::create([
            'from_id_user' => auth()->user()->id,
            'to_id_user' => $request->userTo,
            'content' => $request->userMessage,
            'send_date' => now()
        ]);

        return redirect()->back();
    }

    public function getUser($id)
    {
        $user['data'] = User::find($id);
        
        echo json_encode($user);
        exit;
    }

    public function markRead($id)
    {
        Message::find($id)->update(['read' => 1]);
    }

    public function countBadges()
    {
        $count['data'] = Message::where([['to_id_user', auth()->id()], ['read', 0]])->count();

        echo json_encode($count);
        exit;
    }
}
