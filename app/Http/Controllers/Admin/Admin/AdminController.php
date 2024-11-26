<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Models\Admin;
use App\Models\authz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\adminRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin');

    }


    public function index()
    {
        // return request();
        $admins = Admin::paginate(10);

        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = authz::all();
        return view('admin.admins.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $request->validated();

        $admin =  Admin::create($request->except('password_confirmation'));

        if(!$admin){
            return redirect()->back()->with('error', 'try again later');
        }

        return redirect()->route('admin.admins.index')->with('success', 'admin created successfuly');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = admin::findOrFail($id);

        return view('admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = admin::findOrFail($id);
        $roles = authz::all();
        // dd($roles);
        return view('admin.admins.edit', compact('admin','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request, string $id)
    {



        $date = $request->validated();
        $admin = admin::findOrFail($id);

        if(empty($date['password'])){
            unset($date['password'], $date['password_confirmation']);
        }

        $admin->update($date);

        return redirect()->route('admin.admins.index')->with('success', 'admin updated successfuly');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = admin::findOrFail($id);
        $admin->delete();
        Session::flash('success', 'admin deleted successfuly');
        return redirect()->route('admin.admins.index');
    }

    public function changeStatus($id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin->status == 0) {
            $admin->update([
                'status' => 1
            ]);
            Session::flash('success', 'admin active successfuly');
        } else {
            $admin->update([
                'status' => 0
            ]);
            Session::flash('success', 'admin blocked successfuly');
        }

        return redirect()->back();
    }
}
