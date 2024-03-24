<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companies_temp = Company::Join('companies_types', 'companies.companies_types_id', 'companies_types.id')
        ->leftJoin('size_companies', 'companies.size_companies_id', 'size_companies.id')
        ->leftJoin('cnaes', 'companies.cnaes_id', 'cnaes.id')
        ->leftJoin('legal_forms', 'companies.legal_forms_id', 'legal_forms.id')
        ->leftJoin('addresses', 'companies.addresses_id', 'addresses.id')

        ->select(
            'companies.id',
            'companies.cnpj',
            'companies.name',
            'cnaes.description AS cnaes_id',
            'legal_forms.description AS legal_forms',
            'companies.status',
            'companies.dt_estabilishment',
            'companies.updated_at',
        );
        
        $companies_temp = $companies_temp->get();
 
        if ($request->ajax()) {
            $allData = DataTables::of($companies_temp)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#detalharEmpresa" data-id="'
                .$row->id.'" data-original-tittle="Detalhar" class="analyze btn btn-outline-primary btn-sm">Detalhar</a>';
                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true);

            return $allData;
        }


        // dd($companies);

        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            
        ]);

        $role = Company::Create(
            [
                'description' => $request->description,
            ]
        );
             
        return response()->json(['success'=>'Empresa incluída com sucesso.']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
