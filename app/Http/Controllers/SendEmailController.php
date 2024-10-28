<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendEmailController extends Controller
{
    //
    public function index()
    {
        return view("send_email");
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            "name"      =>  "required",
            "email"     =>  "required|email",
            "message"   =>  "required"
        ]);
        $data =[
            "name"      =>  $request->name,
            "message"   =>  $request->message
        ];

        Mail::to("hugoedu.2810@gmail.com")
            ->send(new SendMail($data));
        return back()->with("success","correo enviado");
    }
}
