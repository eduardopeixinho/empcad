<?php

namespace App\Http\Controllers;

use App\Models\CompanyTest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompanyTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $companies_temp = CompanyTest::select(
            'id',
            'cnpj',
            'name',
            'cnaes_id',
            'legal_forms',
            'status',
            'created_at',
            'updated_at',
        );
        
        $companies_temp = $companies_temp->get();
 
        if ($request->ajax()) {
            $allData = DataTables::of($companies_temp)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'
                .$row->id.'" data-original-tittle="Editar" class="edit btn btn-outline-primary btn-sm ">Editar</a>';

                $btn.= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'
                .$row->id.'" data-original-tittle="Delete" class="delete btn btn-outline-danger btn-sm">Excluir</a>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true);

            return $allData;
        }


        // dd($companies);

        return view('companies-test.index');
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
            'cnpj' => 'required|cnpj',
            'name' => 'required',
            'cnaes_id' => 'required',
            'legal_forms' => 'required',
            'status' => 'required',            
        ]);

        $company = CompanyTest::Create(
            [
                'cnpj' => $request->cnpj,
                'name' => $request->name,
                'cnaes_id' => $request->cnaes_id,
                'legal_forms' => $request->legal_forms,
                'status' => $request->status,
        
            ]
        );
             
        return response()->json(['success'=>'Porte da Empresa incluído com sucesso.']);
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
        $company = CompanyTest::find($id);

        return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'cnpj' => 'required|cnpj',
            'name' => 'required',
            'cnaes_id' => 'required',
            'legal_forms' => 'required',
            'status' => 'required',
        ]);

        $company = CompanyTest::find($id);
        $company->cnpj = $request->input('cnpj');
        $company->name = $request->input('name');
        $company->cnaes_id = $request->input('cnaes_id');
        $company->legal_forms = $request->input('legal_forms');
        $company->status = $request->input('status');
        
        $company->update();


        return response()->json(['success'=>'Empresa atualizada com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = CompanyTest::find($id);

        $company->delete();

        return response()->json(['success'=>'Empresa excluída com sucesso.']);

    }
}
