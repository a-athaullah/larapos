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
        $store = Store::where('store_id', Auth::user()->store_id)->first();
        
        $errors = [];
        $success = [];
        $data = [
            'name' => trim(strtolower($request['name'])),
            'store_id' => $store->store_id,
        ];
        switch ($request->action) {
            case "create":
                if (count($store->categories->where('name',$data['name'])) > 0){
                    array_push($errors, "Category Name already exist");
                }else{
                    Category::create($data);
                    array_push($success, "Success creating new Category");
                }
                break;
            case "edit":
                if ($selectedCategory = $store->categories->find($request['category_id'])){
                    $selectedCategory->update($data);
                    array_push($success, "Success updating category");
                }else{
                    array_push($errors, "Category not found");
                }
                break;
            case "delete":
                if ($selectedCategory = $store->categories->find($request['category_id'])){
                    $selectedCategory->delete();
                    array_push($success, "Success deleting category");
                }else{
                    array_push($errors, "Category not found");
                }
                break;
            default:
                array_push($errors, "Forbidden action");;
                break;
        }
       
        return back()->with('created', $success)->with('errors',$errors);
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
