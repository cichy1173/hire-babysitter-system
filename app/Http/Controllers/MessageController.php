<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use SebastianBergmann\Environment\Console;
use Illuminate\Contracts\Encryption\DecryptException;

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
            
            foreach ($msg as $key2 => $one_msg) {
                try {
                    $one_msg->content = Crypt::decryptString($one_msg->content);
                } catch (DecryptException $e) {
                    $one_msg->content = Crypt::decryptString($one_msg->content);
                }
            }

            $usr = User::find($value);

            $msg->put('lastMessage', $msg->last());
            $user = User::find($msg->last()->from_id_user);
            $msg->put('lastMessage_user', $user->name);
            $msg->put('otherUser_id', $usr['id']);
            $msg->put('otherUser_name', $usr['name']);
            $msg->put('otherUser_surname', $usr['surname']);
            $msg->put('otherUser_nickname', $usr['nickname']);
            $msg->put('otherUser_photo', $usr['photo']);

            array_push($messages, $msg); 
        }

        $users = User::all()->where('id', '!=', auth()->id())->where('id', '!=', 1) ->sortBy('nickname');
        
        return view('Message.messageList', [
            'messages' => $messages,
            'users' => $users
        ]);
    }


    public function newMessage(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'userTo' => 'required|int|exists:users,id|min:2',
            'userMessage' => 'required|string|max:2000',
            'photo' => 'nullable|file|image|max:4096'
        ]);
        
        $content = Crypt::encryptString($request->userMessage);

        

        if($request->file('photo') == null)
        {
            Message::create([
                'from_id_user' => auth()->user()->id,
                'to_id_user' => $request->userTo,
                'content' =>  $content,
                'send_date' => now()
            ]);
    
            return redirect()->back();
        }

        $path = $request->file('photo')->store('public/messageFiles');
        $pathDatabase = str_replace('public', 'storage', $path);
        
        Message::create([
            'from_id_user' => auth()->user()->id,
            'to_id_user' => $request->userTo,
            'content' =>  $content,
            'photo' => $pathDatabase,
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
        $count['messages'] = Message::where([['to_id_user', auth()->id()], ['read', 0]])->count();

        $applicationCounter = 0;

        if(auth()->user()->id_account_type == 2)
        {
            foreach (auth()->user()->advertisements as $key => $advertisement) {
                $applicationCounter += DB::table('users_advertisements')->where([['id_advertisement', $advertisement->id], ['accepted', 0], ['read_by_parent', 0]])->count();
            }
            foreach (auth()->user()->myApplications as $key => $value) {
                if($value->pivot->accepted == 1 && $value->pivot->read_by_parent == 0)
                {
                    $applicationCounter += 1;
                }
            }
        }
        elseif(auth()->user()->id_account_type == 1)
        {
            $applicationCounter = DB::table('users_advertisements')->where([['id_user', auth()->id()], ['accepted', 1], ['read_by_nanny', 0]])->count();
            foreach (auth()->user()->advertisements as $key => $advertisement) {
                $applicationCounter += DB::table('users_advertisements')->where([['id_advertisement', $advertisement->id], ['accepted', 0], ['read_by_nanny', 0]])->count();
            }
        }
        $count['applications'] = $applicationCounter;

        echo json_encode($count);
        exit;
    }
}
