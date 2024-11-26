<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\UserRequest;
use App\utils\ImageManger;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users');
        $this->middleware('can:delete-user')->only('destroy');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return request();
        $users = User::when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%')
                ->orwhere('email', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        })
            ->orderBy(request('sort_by', 'id'), request('order_by', 'asc'))
            ->paginate(request('limit_by', 5));
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $request->validated();

       try{
        DB::beginTransaction();
        $request->merge([
          'email_verified_at' =>  $request->email_verified_at == 1 ? now(): null,
        ]);

        $user =  User::create($request->except('image','password_confirmation'));

         ImageManger::uploadImage($request,null,$user);

        DB::commit();

       }catch(\Exception $e){

        DB::rollBack();
        return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
       }
       return redirect()->route('admin.users.index')->with('success','User created successfuly');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if (File::exists(public_path($user->image))) {
            File::delete(public_path($user->image));
        };

        $user->delete();
        Session::flash('success', 'user deleted successfuly');
        return redirect()->route('admin.users.index');
    }

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 0) {
            $user->update([
                'status' => 1
            ]);
            Session::flash('success', 'user active successfuly');
        } else {
            $user->update([
                'status' => 0
            ]);
            Session::flash('success', 'user blocked successfuly');
        }

        return redirect()->back();
    }
}
