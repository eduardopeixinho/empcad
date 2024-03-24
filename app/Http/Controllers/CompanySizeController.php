<?php

namespace App\Http\Controllers;

use App\Models\SizeCompany;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CompanySizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $role_temp = SizeCompany::get();

 /*       $role_temp = $role_temp->map(function (SizeCompany $i) {
            $i['created'] = $i['created_at'];
            $i['updated'] = $i['updated_at'];
            return $i;
        });
*/
        $role = $role_temp;

        if ($request->ajax()) {
            $allData = DataTables::of($role)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';
                    $btn.= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'
                    .$row->id.'" data-original-tittle="Editar" class="edit btn btn-outline-primary btn-sm ">Editar</a>';
                    $btn.= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'
                    .$row->id.'" data-original-tittle="Delete" class="delete btn btn-outline-danger btn-sm">Excluir</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
            return $allData;
        }

        return view('companies-size.index', compact('role'));
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

        $role = SizeCompany::Create(
            [
                'description' => $request->description,
            ]
        );
/*
        $changes = $role->toArray();
        $ip = null;
        $userId = 'Id: '.Auth::id().' - '.Auth::user()->email;

        event(new CrudEvent($role, 'Inclusão - Papéis - '.__METHOD__, $ip, $userId, $changes));*/
             
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
        $size_company = SizeCompany::find($id);

        return response()->json($size_company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'description' => 'required',

        ]);

        $size_company = SizeCompany::find($id);

        $size_company->description = $request->input('description');

        $size_company->update();


        return response()->json(['success'=>'Porte da Empresa atualizado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $size_company = SizeCompany::find($id);
     
        $size_company->delete();
        
        return response()->json(['success'=>'Porte da Empresa excluído com sucesso.']);        
    }
}
