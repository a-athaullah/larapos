<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\SaleRequest;
use App\Product;
use App\Sale;
use App\Store;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SaleController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get the store information
        $store = Store::where('store_id', Auth::user()->store_id)->first();
        $storeName = str_replace(' ','',ucwords($store->name)) ;

        $products = $store->products->sortByDesc('total_sold')->sortByDesc('product_id');

        $sales = $store->sales()->whereDate('created_at', Carbon::today())->get();
        //Total of sales today
        $totalSalesPerDay = 0;

        $revenue = 0;
        $profit = 0;
        foreach ($sales as $sale) {
            $revenue += $sale->total;
            $profit += ($sale->total - $sale->total_cost);
        }
        
        return view(
            'sales.create',
            compact('store', 'storeName','products', 'sales', 'revenue', 'profit')
        );
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get the store information
        $store = Store::where('store_id', Auth::user()->store_id)->first();
        $storeName = str_replace(' ','',ucwords($store->name)) ;
        // $clients = Client::orderBy('rfc', 'DESC')->get();
        //Get the products information
        $products = Product::orderBy('name', 'DESC')->get();
        //Total of sales today
        $totalSalesPerDay = 0;
        // $salesToday = Sale::select('total')->where('created', date('Y-m-d'))
        //     ->get();

        foreach ($salesToday as $sale) {
            $totalSalesPerDay += $sale->total;
        }

        return view('sales.create');
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(SaleRequest $request)
    {
        //Get the store information
        $store = Store::where('store_id', Auth::user()->store_id)->first();
        $errors = [];
        $success = [];
        $data = [
            'total' => $request->total,
            'store_id' => $request->store_id,
            'notes' => trim($request->notes),
            'total_cost' => $request->total_cost,
            'store_id' => $store->store_id,
            'id' => $request->id,
        ];
        $carts = [];
        if($request->carts){
            $carts = $request->carts;
            switch ($request->action) {
                case "save_only":
                    $newSale =$store->sales()->create($data);
                    $newSale->carts()->createMany($carts);
                    array_push($success, "Success store transaction");
                    break;
                case "save_pay":
                    dd($request);
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
                case "pay_serve":
                    dd($request);
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
        }
        else{
            array_push($errors, "carts can not be mepty");
        }

        
       
        return back()->with('created', $success)->with('errors',$errors);
    }

    /*
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //Cart information
        $carts = Cart::where('sale_id', $sale->sale_id)->get();

        return view('sales.single', compact('sale', 'carts'));
    }

    /*
     * Returns a response with the file provided by SalesExport
     * */
    public function export()
    {
        if (Sale::all()->count() > 0) {
            return Excel::download(new SalesExport(), 'sales.xlsx');
        }
        return back();
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        try {
            $sale->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Error');
        }
        return back()->with('deleted', true);
    }
}
