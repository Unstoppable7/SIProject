<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Product;
use App\Company;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        //TODO cualquier problema hacer dd(datos) para ver como se estan enviando los datos
        //TODO validacion en App/Http/Request/ProductRequest
        $product = Product::create([
            "user_id" => auth()->user()->id
        //obtener el campo user_id de post ||lo buscamos en autenticados/usuarios/id
        ]+ $request->all() );


        $product->save();
        //status es una variable de session que se está usando en las vistas
        return back()->with("status","Creado con exito");

   }
 //logica FUNCION STORE:
        //1//creamos un post con el user_id y los datos del form de creacion
        //2//agarramos toda la info del form
        //3// si recibimos img:
            // (la guardamos en carpeta storage/app/public
            //en public se generara la carpeta "posts"
            // ahi se generara una ruta, y esa ruta se guarda en base de datos )
        //4 guardamos
        //5 retornamos a la vista anterior con un alert que dice creado con exit

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view("products.edit", compact('product'));
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
        $product->update(($request)->all()); //actualizamos todos los campos

        $product->save();
        return back()->with('status',"Actualizado con exito !");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
       $product->delete();

       return back()->with('status',"Eliminado con exito!");
    }
}
