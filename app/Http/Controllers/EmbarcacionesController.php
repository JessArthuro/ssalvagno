<?php

namespace App\Http\Controllers;

use App\Models\Embarcacion;
use Illuminate\Http\Request;

class EmbarcacionesController extends Controller
{
    public function index()
    {
        $boats = Embarcacion::all();
        return view('boats.index', compact('boats'));
    }

    public function create()
    {
        return view('boats.create');
    }

    public function store(Request $request)
    {
        $boat = $request->validate([
            'nombre' => 'required',
        ]);
        Embarcacion::create($boat);
        return redirect()->route('boats.index');
    }

    public function edit($id)
    {
        $boat = Embarcacion::find($id);
        return view('boats.edit', compact('boat'));
    }

    public function update(Request $request, $id)
    {
        $boat = Embarcacion::find($id);
        $data = $request->validate([
            'nombre' => 'required'
        ]);

        $boat->update($data);
        return redirect()->route('boats.index');
    }

    public function destroy($id)
    {
        $boat = Embarcacion::find($id);
        $boat->delete();
        return redirect()->route('boats.index');
    }
}
