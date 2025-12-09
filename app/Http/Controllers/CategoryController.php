<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Store;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $store = Store::where('store_id', Auth::user()->store_id)->first();
        $storeName = str_replace(' ','',ucwords($store->name)) ;

        $categories = $store->categories;

        return view('categories.create', compact('categories','store','storeName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store = Store::where('store_id', Auth::user()->store_id)->first();
        $storeName = str_replace(' ','',ucwords($store->name)) ;

        return view('categories.create', compact('store','storeName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        return back()->with('created', true);
    }


    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('deleted', true);
    }
}
