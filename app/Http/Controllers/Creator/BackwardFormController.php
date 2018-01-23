<?php

namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Mail;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Auth;

class BackwardFormController extends Controller
{
    public function show(){
        return view('creator.backwardForm');
    }

    public function ss(){
        return view('creator.backwardForm');
    }

    public function send(Request $request){
        $id = Auth::id();
        $user = array(
            'email' => $request->get('email'),
        );

        $data = array(
            'email' => $request->get('email'),
            'message_body' => $request->get('message'),
            'userId' => $id
        );


        Mail::send('creator/contact', $data, function ($message) use ($user) {
            $message->to('777quest777@gmail.com')
                ->replyTo($user['email'])
                ->subject('С уважение Quest Team');
        });


        return redirect('users/view')->with('success', 'Ваше сообщение отправлено!');
    }
}
