<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('car.index', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_identity' => 'required|string|max:50|unique:cars,unit_identity'
        ]);

        Car::create([
            'unit_identity' => strtoupper($request->unit_identity)
        ]);

        return redirect()->route('car.index')->with('success', 'Car berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('car.index')->with('success', 'Car berhasil dihapus.');
    }
}
