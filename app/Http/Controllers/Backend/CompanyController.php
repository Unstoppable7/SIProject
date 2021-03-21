<?php

namespace App\Http\Controllers\Backend;

use App\Audit;
use App\Company;
use App\Binnacle;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use Carbon;

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
        return view('companies.index', compact('companies'));
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
        $row_code = $total_companies->count();

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
        return back()->with("status","created successfully");
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
        $user = auth()->user();
        $last_binnacle_id = NULL;
        if(count($user->binnacles)>0){
            $last_binnacle_id = $user->binnacles->last()->id;
        }

        $bitac = Binnacle::create([
            'binnacle_id' => $last_binnacle_id,
            'user_id' => auth()->user()->id,
        ]);

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
        $total_companies = DB::table('companies')->get();

        $cont = 0;
        foreach ($total_companies as $total_company) {
            $cont += 1;
            if($total_company->id == $company->id){
                break;
            }
        }

        $audit = Audit::create([
            'table_name' => 'companies',
            'row_code' => $cont,
            'operation_type_code' => 'update',
            'statement' => $company->toSql(),
            //'error' =>
            'user_id' => auth()->user()->id,
            'ip_code' => $_SERVER['REMOTE_ADDR'],
            ]);
        $audit->save();
        $company->update(($request)->all()); //actualizamos todos los campos

        $company->save();

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
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $total_companies = DB::table('companies')->get();

        $cont = 0;
        foreach ($total_companies as $total_company) {
            $cont += 1;
            if($total_company->id == $company->id){
                break;
            }
        }

        $audit = Audit::create([
            'table_name' => 'companies',
            'row_code' => $cont,
            'operation_type_code' => 'delete',
            'statement' => $company->toSql(),
            //'error' =>
            'user_id' => auth()->user()->id,
            'ip_code' => $_SERVER['REMOTE_ADDR'],
        ]);
        $audit->save();

        $company->products()->detach();
        $company->delete();

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
