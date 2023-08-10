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
        $cotizacionData = $request->only(['fecha_cot', 'num_cotizacion', 'num_orden', 'nombre', 'empresa_id', 'fecha_ent', 'hora_ent', 'fecha_sal', 'lugar_ent']);
        $cotizacion = Cotizacion::create($cotizacionData);

        $serviciosData = $request->input('servicios', []);

        foreach ($serviciosData as $servicioData) {
            $servicio = new Servicio();
            $servicio->alimentos_ids = $servicioData['alimentos_ids'];
            $servicio->fecha_serv = $servicioData['fecha_serv'];
            $servicio->cantidad = $servicioData['cantidad'];
            $servicio->precio_unitario = $servicioData['precio_unitario'];
            $servicio->total = $servicioData['total'];
            $servicio->costo_envio = $servicioData['costo_envio'];

            $cotizacion->servicios()->save($servicio);

            $huespedesData = $servicioData['huespedes'] ?? [];

            foreach ($huespedesData as $huespedData) {
                $huesped = new Huesped();
                $huesped->nombre_h = $huespedData['nombre_h'];
                $huesped->embarcacion_id = $huespedData['embarcacion_id'];
                $huesped->desayunos = $huespedData['desayunos'];
                $huesped->comidas = $huespedData['comidas'];
                $huesped->cenas = $huespedData['cenas'];
                $huesped->save();

                $servicio->huespedes()->attach($huesped);
            }
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
