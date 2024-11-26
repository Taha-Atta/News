<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:category');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withcount('posts')->when(request()->keyword, function ($query) {
            $query->where('name', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        })
            ->orderBy(request('sort_by', 'id'), request('order_by', 'asc'))
            ->paginate(request('limit_by', 10));


        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:50",
            'status' => "required|in:1,0",
        ]);
        $category = Category::create([ 'name' => $request->name,'status' => $request->status,]);

        if (!$category) {
            Session::flash('error', 'there ara error');
            return redirect()->back();
        }
        Session::flash('success', 'category created successfuly');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $request->validate([ 'name' => "required|string|max:50", 'status' => "required|in:1,0",]);
        $category = Category::findOrFail($id);
        $category->update([ 'name' => $request->name,'status' => $request->status,]);
        Session::flash('success', 'category updated successfuly');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Session::flash('success', 'category deleted successfuly');
        return redirect()->route('admin.categories.index');
    }

    public function changeStatus($id)
    {
        $category = Category::findOrFail($id);
        if ($category->status == 0) {
            $category->update([
                'status' => 1
            ]);
            Session::flash('success', 'category active successfuly');
        } else {
            $category->update([
                'status' => 0
            ]);
            Session::flash('success', 'category blocked successfuly');
        }

        return redirect()->back();
    }
}
