<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;

class MessageController extends Controller {

    public function __construct()
	{
		$this->middleware('auth');
	}

    //Metodo sent, este recibe el objeto request, el cual recibe la data que pasaremos mediante JS
	public function sent(Request $request) {

		$message = auth()->user()->messages()->create([
			'content' => $request->message,
			'chat_id' => $request->chat_id
		])->load('user');

		broadcast(new MessageSent($message))->toOthers();

		return $message;

	}

}