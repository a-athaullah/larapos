<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductVarian;
use App\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $store = Store::where('store_id', Auth::user()->store_id)->first();
        $products = $store->products->sortByDesc('total_sold')->sortByDesc('product_id');
        $storeName = str_replace(' ','',ucwords($store->name)) ;
        $categories = Category::all();
        return view('products.create', compact('categories', 'store', 'storeName', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Get the store information
        $store = Store::where('store_id', Auth::user()->store_id)->first();
        $storeName = str_replace(' ','',ucwords($store->name)) ;
        $categories = Category::all();
        return view('products.create', compact('categories', 'store', 'storeName'));
    }

    /*
     *  Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //Get the store information
        $store = Store::where('store_id', Auth::user()->store_id)->first();
        $errors = [];
        $success = [];
        $data = [
            'name' => trim($request->name),
            'description' => trim($request->description),
            'product_left' => $request->product_left,
            'price' => $request->price,
            'cost' => $request->cost,
            'category_id' => $request->category_id,
            'store_id' => $store->store_id,
        ];
        $varians = [];
        if($request->varian){
            foreach ($request->varian as $data_varian) {
                array_push($varians, [
                    'name' => trim($data_varian),
                    'store_id' => $store->store_id
                ]);
            }
        }

        switch ($request->action) {
            case "create":
                $newProduct =$store->products()->create($data);
                if ($varians){
                    $newProduct->varians()->createMany($varians);
                }
                array_push($success, "Success creating new Product");
                break;
            case "edit":
                if ($selectedProduct = $store->products->find($request['product_id'])){
                    $selectedProduct->varians()->delete();
                    $selectedProduct->update($data);
                    if ($varians){
                        $selectedProduct->varians()->createMany($varians);
                    }
                    array_push($success, "Success updating category");
                }else{
                    array_push($errors, "Category not found");
                }
                break;
            case "delete":
                if ($selectedProduct = $store->products->find($request['product_id'])){
                    $selectedProduct->delete();
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

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /*
    * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return back()->with('updated', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('error', false);
    }
}
