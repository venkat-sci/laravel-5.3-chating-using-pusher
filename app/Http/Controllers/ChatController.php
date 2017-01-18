<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\App;

class ChatController extends Controller
{
	var $pusher;
	var $chatChannel;

	const DEFAULT_CHAT_CHANNEL = 'chat';
	public function __construct()
    {
        $this->pusher = App::make('pusher');
        $this->chatChannel = self::DEFAULT_CHAT_CHANNEL;
    }

    public function getIndex(){

    	return view('chat', ['chatChannel' => $this->chatChannel]);
    }

    public function postMessage(Request $request){
      
    	$message = [
            'text' => e($request->input('chat_text')),
            'author' => e($request->input('author')),
            'timestamp' => (time()*1000)
        ];

        $this->pusher->trigger($this->chatChannel, 'new-message', $message);

    }	

    //
}
