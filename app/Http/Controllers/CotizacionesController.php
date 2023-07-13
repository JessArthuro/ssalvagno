<?php

namespace App\Http\Controllers;

use App\Models\Cotizacion;
use App\Models\Empresa;
use Illuminate\Http\Request;

class CotizacionesController extends Controller
{
    public function index()
    {
        $quotes = Cotizacion::all();
        return view('quotes.index', compact('quotes'));
    }

    public function create()
    {
        $companies = Empresa::all();
        return view('quotes.create', compact('companies'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
