<?php

namespace App\Http\Controllers;

use App\Exports\CotizacionesExport;
use App\Models\Alimento;
use App\Models\Cotizacion;
use App\Models\Embarcacion;
use App\Models\Empresa;
use App\Models\Huesped;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

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
            // $service->alimentos_ids = serialize($servData['alimentos_ids']);
            $service->alimentos_ids = json_encode($servData['alimentos_ids']);
            $service->fecha_serv = $servData['fecha_serv'];
            $service->cantidad = $servData['cantidad'];
            $service->precio_unitario = $servData['precio_unitario'];
            $service->total = $servData['total'];
            $service->costo_envio = $servData['costo_envio'];

            $cotizacion->servicios()->save($service);
        }

        $guestsData = $request->input('huespedes', []);

        foreach ($guestsData as $guestData) {
            $guest = new Huesped();
            $guest->nombre = $guestData['nombre']; 
            $guest->desayunos = $guestData['desayunos']; 
            $guest->comidas = $guestData['comidas']; 
            $guest->cenas = $guestData['cenas']; 
            $guest->embarcacion_id = $guestData['embarcacion_id']; 

            $service->huespedes()->save($guest);
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

    public function pdf($id)
    {
        $quote = Cotizacion::find($id);
        $pdf = Pdf::loadView('quotes.pdf', compact('quote'));
        $filename = "Cotizacion_" . $quote->num_cotizacion . ".pdf";
        return $pdf->stream($filename);
    }

    public function excel(Request $request)
    {
        $id = $request->input('id');

        $quote = Cotizacion::with('servicios')->find($id);
        $filename = "Cotizacion_" . $quote->num_cotizacion . ".xlsx";
        return Excel::download(new CotizacionesExport($quote), $filename);
    }
}
