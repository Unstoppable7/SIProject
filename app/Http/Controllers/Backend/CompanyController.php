<?php

namespace App\Http\Controllers\Backend;

use App\Audit;
use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;

use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::get();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("companies.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company = Company::create([
            'branch_status' => true,
            'active_status' => true
        ]+ $request->all());

        $total_companies = DB::table('companies')->get();
        $row_code = $total_companies->count() + 1;

        $audit = Audit::create([
            'table_name' => 'companies',
            'row_code' => $row_code,
            'operation_type_code' => 'insert',
            'statement' => $company->toSql(),
            //'error' =>
            'user_id' => auth()->user()->id,
            'ip_code' => $_SERVER['REMOTE_ADDR'],
        ]);
        $audit->save();

        $company->update([
            'audit_id' => $audit->id,
        ]);

        $company->save();

        //status es una variable de session que se está usando en las vistas
        return back()->with("status","Creado con exito");
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Company  $company
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Company $company)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view("companies.edit", compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update(($request)->all()); //actualizamos todos los campos

        $company->save();

        return back()->with('status',"Actualizado con exito !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

       return back()->with('status',"Eliminado con exito!");
    }
}
