<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with(['driver', 'car'])->latest()->get();
        return view('trip.index', compact('trips'));
    }


    public function create()
    {
        $drivers = Driver::orderBy('name')->get();
        $cars = Car::orderBy('unit_identity')->get();

        return view('trip.create', compact('drivers', 'cars'));
    }

    public function edit($id)
    {
        $trip = Trip::findOrFail($id);

        $drivers = Driver::orderBy('name')->get();
        $cars = Car::orderBy('unit_identity')->get();

        return view('trip.edit', compact('trip', 'drivers', 'cars'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:departure_date',

            'driver_id' => 'required|exists:drivers,id',
            'car_id' => 'required|exists:cars,id',

            'start_place' => 'required|string|max:255',
            'end_place' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',

            'passengers_amount' => 'required|integer|min:1',

            'departure_total' => 'required|numeric|min:0',
            'departure_description' => 'string|max:255',

            'return_total' => 'required|numeric|min:0',
            'return_description' => 'string|max:255',

            'fee_total' => 'required|numeric|min:0',
        ]);

        $trip_total = $validated['departure_total'] + $validated['return_total'] + $validated['fee_total'];

        Trip::create([
            ...$validated,
            'trip_total' => $trip_total,
        ]);

        return redirect()->route('trip.index')->with('success', 'Trip berhasil dibuat.');
    }

}
