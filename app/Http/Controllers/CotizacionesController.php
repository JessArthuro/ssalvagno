<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use App\Models\Cotizacion;
use App\Models\Embarcacion;
use App\Models\Empresa;
use App\Models\Servicio;
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

        $companies = Empresa::all();
        $boats = Embarcacion::all();
        $foods = Alimento::all();
        return view('quotes.create', compact('quote', 'companies', 'folio', 'boats', 'foods'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        $cotizacion = Cotizacion::create($data);

        $servicesData = $request->input('servicios', []);
        // $empleado['dias_acceso'] = serialize($empleado['dias_acceso']);

        foreach ($servicesData as $servData) {
            $service = new Servicio();
            // $service->servicio = $servData['servicio'];
            $service->servicio = serialize($servData['servicio']);
            $service->fecha_serv = $servData['fecha_serv'];
            $service->huesped = $servData['huesped'];
            $service->cantidad = $servData['cantidad'];
            $service->precio_unitario = $servData['precio_unitario'];
            $service->total = $servData['total'];

            $cotizacion->servicios()->save($service);
        }

        return redirect()->route('quotes.index');
    }

    public function show($id)
    {
        $quote = Cotizacion::find($id);
        return view('quotes.show', compact('quote'));
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
