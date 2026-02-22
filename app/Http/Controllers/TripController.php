<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\Deposit;
use App\Models\Trip;
use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with(['driver', 'car'])->latest()->get();
        return view('trip.index', compact('trips'));
    }


    public function create()
    {
        $driver = Driver::where('user_id', '=', Auth::id())->first();
        $cars = Car::orderBy('unit_identity')->get();

        return view('trip.create', compact('driver', 'cars'));
    }

    public function edit($id)
    {
        $trip = Trip::findOrFail($id);

        $drivers = Driver::orderBy('id')->get();
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

            'route_1' => 'required|string|max:255',
            'route_2' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',

            'passengers_amount' => 'required|integer|min:1',

            'departure_total' => 'required|numeric|min:0',
            'departure_description' => 'nullable|string|max:255',

            'return_total' => 'required|numeric|min:0',
            'return_description' => 'nullable|string|max:255',

            'lunas_kantor' => 'numeric|min:0',

            'fee_total' => 'numeric|min:0',

            'angsuran_total' => 'numeric|min:0|required',

            // Costs

            'bbm_total' => 'required|numeric|min:0',
            'bbm_attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            'wash_total' => 'required|numeric|min:0',
            'makan_total' => 'required|numeric|min:0',

            'parking_total' => 'required|numeric|min:0',
            'parking_attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            'repair_total' => 'required|numeric|min:0',
            'repair_attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            'pom_total' => 'required|numeric|min:0',

            'cost_total' => 'required|numeric|min:0',

        ]);
        try {

            DB::beginTransaction();

            $trip_total = $validated['departure_total']
                + $validated['return_total'];

            $cost_total = $validated['bbm_total']
                + $validated['wash_total']
                + $validated['makan_total']
                + $validated['parking_total']
                + $validated['repair_total']
                + $validated['pom_total'];

            $trip = Trip::create([
                ...$validated,
                'trip_total' => $trip_total,
            ]);

            $cost = Cost::create([
                ...$validated,
                'trip_id' => $trip->id,
                'cost_total' => $cost_total
            ]);

            $driver = Driver::where('user_id','=',Auth::id())->first();
            $total_tripcost = $trip_total - $cost_total;
            $total_driver = $total_tripcost * ($driver->persentase_hasil / 100);
            $total_company = $total_tripcost - $total_driver;
            $total_deposit = $total_company + $driver->tanggungan_koperasi + $cost->repair_total + $trip->fee_total;

            Deposit::create([
                'trip_id' => $trip->id,
                'total_deposit' => $total_deposit,
                'total_driver' => $total_driver,
                'total_company' => $total_company,
                'total_koperasi' => $validated['angsuran_total'],
                'status' => 'Pending'
            ]);

            $driver->tanggungan_koperasi = $driver->tanggungan_koperasi - $validated['angsuran_total'];
            $driver->save();

            DB::commit();

            return redirect()
                ->route('my-trips.index')
                ->with('success', 'Trip berhasil dibuat.');

        } catch (\Throwable $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
                // 'Gagal membuat trip. Silakan coba lagi.'
        }
    }

    public function myTrips()
    {
        $driver = Driver::where('user_id','=',Auth::id())->first();
        $trips = Trip::with(['driver', 'car','deposit'])->where('driver_id', '=', $driver->id)->latest()->get();
        return view('trip.index', compact('trips'));
    }

}
