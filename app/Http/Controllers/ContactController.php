<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    //
    public function contact(){
        return view('user.home.contact');
    }

    public function contactForm(Request $request){
        Contact::create([
            'user_id'=> $request->user_id,
            'title'=> $request->title,
            'message'=> $request->message,
        ]);
        Alert::success('Contact Form', 'has been created successfully');
        return to_route('userHome');
    }

}
