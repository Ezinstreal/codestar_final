<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class SendMessageController extends Controller
{
    public function index()
    {
        return view('send_message');
    }
    public function sendMessage(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $data['title'] = $request->input('title');
        $data['content'] = $request->input('content');

        // dd($data);
        $options = array(
            'cluster' => 'ap',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        // $pusher->trigger('Notify', 'send-message', $data);
        $pusher->trigger('Notifyl', 'send-message', [

            'message' => 'hello world'

          ]);
        return redirect()->route('send');
    }
}
