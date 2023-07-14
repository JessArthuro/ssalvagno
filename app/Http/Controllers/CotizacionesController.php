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
        $quote = new Cotizacion();
        $folio = $quote->generateFolio();
        // session()->flashInput(['num_cotizacion' => $quote->num_cotizacion]);

        $companies = Empresa::all();
        return view('quotes.create', compact('quote', 'companies', 'folio'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Cotizacion::create($data);
        return redirect()->route('quotes.index');
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
