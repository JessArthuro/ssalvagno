<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    public function index()
    {
        $services = Servicio::all();
        // $services['servicio'] = unserialize($services['servicio']);

        // $services = Servicio::all()->map(function ($service){
        //     $service->servicio = unserialize($service->servicio);
        //     return $service;
        // });
        return view('services.index', compact('services'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
