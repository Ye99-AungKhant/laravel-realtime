<?php

namespace App\Http\Controllers;

use App\Events\GreetingSend;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChat(){
        return view('chat.show');
    }

    public function messageReceived(Request $request){
        $rules = [
            'message' => 'required'
        ];
        $request->validate($rules);

        broadcast(new MessageSent($request->user(), $request->message));

        return response()->json('Message broadcast');
    }


    //$request->user()->name is login user name
    public function greetReceived(Request $request, User $user){
        broadcast(new GreetingSend($user, "{$request->user()->name} greet")); //receiver
        broadcast(new GreetingSend($request->user(), "You greeted  {$user->name}")); //sender

        return "Greeting {$user->name} from {$request->user()->name}";
    }
}
