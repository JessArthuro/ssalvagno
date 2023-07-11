<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use Illuminate\Http\Request;

class AlimentosController extends Controller
{
    public function index()
    {
        $foods = Alimento::all();
        return view('foods.index', compact('foods'));
    }

    public function create()
    {
        return view('foods.create');
    }

    public function store(Request $request)
    {
        $food = $request->validate([
            'nombre' => ['required', 'regex:/^[a-zA-Z\sñÑ]+$/'],
            'precio' => 'required|numeric|min:0'
        ]);
        Alimento::create($food);
        return redirect()->route('foods.index');
    }

    public function edit($id)
    {
        $food = Alimento::find($id);
        return view('foods.edit', compact('food'));
    }

    public function update(Request $request, $id)
    {
        $food = Alimento::find($id);
        $data = $request->validate([
            'nombre' => ['required', 'regex:/^[a-zA-Z\sñÑ]+$/'],
            'precio' => 'required|numeric|min:0'
        ]);

        $food->update($data);
        return redirect()->route('foods.index');
    }

    public function destroy($id)
    {
        $food = Alimento::find($id);
        $food->delete();
        return redirect()->route('foods.index');
    }
}
