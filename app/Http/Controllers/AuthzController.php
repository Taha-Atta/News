<?php

namespace App\Http\Controllers;

use App\Models\authz;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Authz\AuthzRequest;

class AuthzController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:authrization');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $roles = Authz::all();
        return view('admin.authz.index' ,compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.authz.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthzRequest $request)
    {
        $request->validated();
        $authz = new authz();
        $authz->role = $request->role;
        $authz->permissions = json_encode($request->permissions);
        $authz->save();

        return to_route('admin.authz.index')->with('success','role created successfuly');

    }

    /**
     * Display the specified resource.
     */
    public function show(authz $authz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(authz $authz)
    {
        return view('admin.authz.edit',compact('authz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthzRequest $request, authz $authz)
    {
        $request->validated();

        $authz->role = $request->role;
        $authz->permissions = json_encode($request->permissions);
        $authz->save();

        return to_route('admin.authz.index')->with('success','role updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(authz $authz)
    {
        if($authz->admins->count() > 0){
            return redirect()->back()->with('error','plesse remove related admins first!!');
        }
        $authz->delete();
        return to_route('admin.authz.index')->with('success','role deleted successfuly');
    }
}
