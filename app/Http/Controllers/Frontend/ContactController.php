<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewContactNotification;
use App\Http\Requests\Frontend\ContactRequest;

class ContactController extends Controller
{
    public function index(){

        return view('frontend.contact-us');
    }

    public function store(ContactRequest $request){

        $request->validated();

        $request->merge([
            'ip_address'=>$request->ip(),
        ]);
        $contact = Contact::create($request->all());
        $admins = Admin::get();
        Notification::send($admins, new NewContactNotification($contact));

        if(!$contact){
            session()->flash('error', "sorry try again");
            return redirect()->back();
        }
        session()->flash('success', "message sent successfuly");
        // Session::flash('success',"successfuly");
        return redirect()->back();
    }
}
