<?php

namespace App\Http\Controllers\Contacts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ContactsController extends Controller
{
    public function cf() {
              return view('contacts.contacts');
    }

    public function cfp() {
        $user = array(
            'email' => Input::get('email')
        );

        $data = array(
            'email' => Input::get('email'),
            'message_body' => Input::get('message')
        );


        Mail::send('contacts.contact',$data, function($message) use ($user)
        {
            $message->to('777quest777@gmail.com')->subject('Welcome!');
        });

        return redirect()->route('start');
    }
}
