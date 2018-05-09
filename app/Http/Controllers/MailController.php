<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //email
    static public function send($name,$email)
    {
        Mail::send(
            'Mail.mail',
            ['name'=>$name],
            function ($message,$email){
                $message->to($email)->subject('注册确认');
            }
        );
    }
}
