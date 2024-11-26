<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:contact');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return request();
        $contacts = Contact::when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%')
                ->orwhere('email', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        })
            ->orderBy(request('sort_by', 'id'), request('order_by', 'asc'))
            ->paginate(request('limit_by', 10));
        return view('admin.contact.index', compact('contacts'));
    }


    public function showContact($id)
    {

        $contact =  Contact::findOrFail($id);
        $contact->update(['status' => 1]);
        // $notification = Auth('admin')->user()->unreadNotifications()->find($notificationId);

        // if ($notification) {
        //     $notification->markAsRead();
        // }
        return view('admin.contact.show', compact('contact'));
    }



    public function deleteContact($id)
    {
        $contact =  Contact::findOrFail($id);
        $contact->delete();
        return to_route('admin.contact.index')->with('success', 'contact deleted successfuly');
    }
}
