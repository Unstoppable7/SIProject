<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Product;
use App\Company;
use App\Binnacle;
use App\Http\Requests\ProductRequest;
use App\Audit;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Echo_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $last_binnacle_id = NULL;
        if(count($user->binnacles)>0){
            $last_binnacle_id = $user->binnacles->last()->id;
        }

        $bitac = Binnacle::create([
            'binnacle_id' => $last_binnacle_id,
            'user_id' => auth()->user()->id,
        ]);
        $products = Product::get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $last_binnacle_id = NULL;
        if(count($user->binnacles)>0){
            $last_binnacle_id = $user->binnacles->last()->id;
        }

        $bitac = Binnacle::create([
            'binnacle_id' => $last_binnacle_id,
            'user_id' => auth()->user()->id,
        ]);

        $companies = Company::get();

        return view("products.create", compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //dd($request);
        $product = Product::create([
            'audit_id' => 2,
        ]+ $request->all());
        $total_products = DB::table('products')->get();
        $row_code = $total_products->count();

        $audit = Audit::create([
            'table_name' => 'products',
            'row_code' => $row_code,
            'operation_type_code' => 'insert',
            'statement' => $product->toSql(),
            //'error' =>
            'user_id' => auth()->user()->id,
            'ip_code' => $_SERVER['REMOTE_ADDR'],
            ]);
        $audit->save();

        $product->update([
            'audit_id' => $audit->id,
        ]);

        // $find = Product::where('name', '=', $request->name)->count() > 0;
        //     dd($find);
        // if($find)
        // {
        //     //foreach ($product->companies as $company) {

        //         $product->companies()->sync([
        //             'original_stock_number' => $product->companies()->pivot->original_stock_number + 1
        //         ]);
        //     //}

        // }else
        // {
            //dd($request->selection);
            //dd($product->id);
            $product->companies()->attach(
                $request->selection,
                ['audit_id' => $audit->id],
                ['in_original' => true],
                ['original_stock_number' => 10],
                ['in_replacement' => false],
                ['replacement_stock_number' => 0],
                ['status' => true]
            );
       //}


        // 1 => ['audit_id' => $audit->id],
        // 2 => ['company_id' => 10],
        // 3 => ['product_id' => $product->id],
        // 4 => ['in_original' => true],
        // 5 => ['original_stock_number' => 1],
        // 5 => ['in_replacement' => false],
        // 6 => ['replacement_stock_number' => 0],
        // 7 => ['status' => true]

        $product->save();

        //status es una variable de session que se está usando en las vistas
        return back()->with("status","created successfully");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $user = auth()->user();
        $last_binnacle_id = NULL;
        if(count($user->binnacles)>0){
            $last_binnacle_id = $user->binnacles->last()->id;
        }

        $bitac = Binnacle::create([
            'binnacle_id' => $last_binnacle_id,
            'user_id' => auth()->user()->id,
        ]);

        $companies = Company::get();

        return view("products.edit", compact('companies', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $total_products = DB::table('products')->get();

        $cont = 0;
        foreach ($total_products as $total_product) {
            $cont += 1;
            if($total_product->id == $product->id){
                break;
            }
        }

        $audit = Audit::create([
            'table_name' => 'products',
            'row_code' => $cont,
            'operation_type_code' => 'update',
            'statement' => $product->toSql(),
            //'error' =>
            'user_id' => auth()->user()->id,
            'ip_code' => $_SERVER['REMOTE_ADDR'],
            ]);
        $audit->save();

        $product->update(($request)->all()); //actualizamos todos los campos

        $product->save();
        if(!$product->companies()->first()){
            $product->companies()->attach(
                $request->selection,
                ['audit_id' => $audit->id],
                ['in_original' => true],
                ['original_stock_number' => 10],
                ['in_replacement' => false],
                ['replacement_stock_number' => 0],
                ['status' => true]
            );
        }else{
            $product->companies()->updateExistingPivot(
                    $request->selection,
                    ['audit_id' => $audit->id],

            );
        }

        $user = auth()->user();
        $last_binnacle_id = NULL;
        if(count($user->binnacles)>0){
            $last_binnacle_id = $user->binnacles->last()->id;
        }

        $bitac = Binnacle::create([
            'binnacle_id' => $last_binnacle_id,
            'user_id' => auth()->user()->id,
        ]);

        return back()->with('status',"updated successfully!");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $total_products = DB::table('products')->get();

        $cont = 0;
        foreach ($total_products as $total_product) {
            $cont += 1;
            if($total_product->id == $product->id){
                break;
            }
        }

        $audit = Audit::create([
            'table_name' => 'products',
            'row_code' => $cont,
            'operation_type_code' => 'delete',
            'statement' => $product->toSql(),
            //'error' =>
            'user_id' => auth()->user()->id,
            'ip_code' => $_SERVER['REMOTE_ADDR'],
        ]);
        $audit->save();

        $product->companies()->detach();
        $product->delete();

        $user = auth()->user();
        $last_binnacle_id = NULL;
        if(count($user->binnacles)>0){
            $last_binnacle_id = $user->binnacles->last()->id;
        }

        $bitac = Binnacle::create([
            'binnacle_id' => $last_binnacle_id,
            'user_id' => auth()->user()->id,
        ]);

        return back()->with('status',"removed successfully!");
    }
}
