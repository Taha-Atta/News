<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;
use function App\Http\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;

use App\Http\Resources\ContactCollection;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewContactNotification;
use App\Http\Requests\Frontend\ContactRequest;

class ContactController extends Controller
{
    public function Contact(ContactRequest $request)
    {
        $request->validated();
        $request->merge([
            'ip_address' => $request->ip(),
        ]);
        $contact = Contact::create($request->all());
        if (!$contact) {
            return ApiResponse(404, 'there is problem');
        }

        $admins = Admin::get();
        Notification::send($admins, new NewContactNotification($contact));
        
        return ApiResponse(201, 'contact created successfuly');
    }
}
