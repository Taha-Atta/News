<?php

namespace App\Http\Controllers\Frontend;


use App\Models\NewSubsciber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Frontend\NewSubcriberMail;
use Illuminate\Support\Facades\Session;

class NewSubsciberController extends Controller
{
    public function store(Request $request){



        $request->validate([
            'email'=>"required|email|unique:new_subscibers,email",
        ]);

        $newSubscriber=NewSubsciber::create([
            'email'=>$request->email,
        ]);

        if(!$newSubscriber){
            session()->flash('error', "sorry try again");
            return redirect()->back();
        }

        // session()->flash('success', "You subscrib successfluy");
        Session::flash('success', "You subscrib successfluy");

        // Mail::to($request->email)->send(new NewSubcriberMail());


        return to_route('frontend.index');
    }
}
