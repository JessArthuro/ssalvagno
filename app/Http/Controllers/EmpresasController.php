<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function index()
    {
        $companies = Empresa::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $company = $request->validate([
            'nombre' => 'required',
        ]);
        Empresa::create($company);
        return redirect()->route('companies.index');
    }

    public function edit($id)
    {
        $company = Empresa::find($id);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = Empresa::find($id);
        $data = $request->validate([
            'nombre' => 'required'
        ]);

        $company->update($data);
        return redirect()->route('companies.index');
    }

    public function destroy($id)
    {
        $company = Empresa::find($id);
        $company->delete();
        return redirect()->route('companies.index');
    }
}
