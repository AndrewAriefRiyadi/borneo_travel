<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Cost;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{


    public function index()
    {
        return view('report.index');
    }
    public function driverIncome(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $query = Trip::query()
            ->join('deposits', 'deposits.trip_id', '=', 'trips.id')
            ->join('drivers', 'drivers.id', '=', 'trips.driver_id')
            ->join('users', 'users.id', '=', 'drivers.user_id')
            ->select(
                'drivers.id as driver_id',
                'users.name as driver_name',
                DB::raw('SUM(deposits.total_company) as total_income')
            )
            ->groupBy('drivers.id', 'users.name');

        if ($from && $to) {
            $query->whereBetween('trips.departure_date', [$from, $to]);
        }

        $reports = $query->get();

        return view('report.driver-income', compact('reports', 'from', 'to'));
    }

    public function driverIncomePrint(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $reports = $this->getDriverIncomeQuery($from, $to);

        return view('report.print.driver-income', compact('reports', 'from', 'to'));
    }

    private function getDriverIncomeQuery($from, $to)
    {
        $query = Trip::query()
            ->join('deposits', 'deposits.trip_id', '=', 'trips.id')
            ->join('drivers', 'drivers.id', '=', 'trips.driver_id')
            ->join('users', 'users.id', '=', 'drivers.user_id')
            ->select(
                'users.name as driver_name',
                DB::raw('SUM(deposits.total_company) as total_income')
            )
            ->groupBy('users.name');

        if ($from && $to) {
            $query->whereBetween('trips.departure_date', [$from, $to]);
        }

        return $query->get();
    }

    public function repairRecap(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $reports = $this->getRepairRecap($from, $to);

        return view('report.repair-recap', compact('reports', 'from', 'to'));
    }

    private function getRepairRecap($from, $to)
    {
        $query = Cost::query()
            ->join('cars', 'cars.id', '=', 'costs.car_id')
            ->select(
                'cars.unit_identity',
                DB::raw('SUM(costs.repair_total) as total_repair'),
                DB::raw('COUNT(costs.id) as total_nota')
            )
            ->groupBy('cars.unit_identity');

        if ($from && $to) {
            $query->whereBetween('costs.repair_date', [$from, $to]);
        }

        return $query->get();
    }

    public function printRepairRecap(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $reports = $this->getRepairRecap($from, $to);

        return view('report.print.repair-recap', compact('reports', 'from', 'to'));
    }

    public function thirdPartyFee(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $reports = $this->getThirdPartyFee($from, $to);

        return view('report.third-party-fee', compact('reports', 'from', 'to'));
    }
    public function printThirdPartyFee(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $reports = $this->getThirdPartyFee($from, $to);

        return view('report.print.third-party-fee', compact('reports', 'from', 'to'));
    }

    private function getThirdPartyFee($from, $to)
    {
        $query = Trip::query()
            ->join('drivers', 'drivers.id', '=', 'trips.driver_id')
            ->join('users', 'users.id', '=', 'drivers.user_id')
            ->select(
                'users.name as driver_name',
                DB::raw('SUM(trips.fee_total) as total_fee'),
                DB::raw('COUNT(trips.id) as total_trip')
            )
            ->groupBy('users.name');

        if ($from && $to) {
            $query->whereBetween('trips.departure_date', [$from, $to]);
        }

        return $query->get();
    }

    public function koperasiPayment(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $reports = $this->getKoperasiPayment($from, $to);

        return view('report.koperasi-payment', compact('reports', 'from', 'to'));
    }

    public function printKoperasiPayment(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $reports = $this->getKoperasiPayment($from, $to);

        return view('report.print.koperasi-payment', compact('reports', 'from', 'to'));
    }

    private function getKoperasiPayment($from, $to)
    {
        $query = Trip::query()
            ->join('drivers', 'drivers.id', '=', 'trips.driver_id')
            ->join('users', 'users.id', '=', 'drivers.user_id')
            ->join('deposits', 'deposits.trip_id', '=', 'trips.id')
            ->select(
                'drivers.id as driver_id',
                'users.name as driver_name',
                'drivers.tanggungan_koperasi',
                DB::raw('COUNT(trips.id) as total_trip'),
                DB::raw('SUM(deposits.total_koperasi) as total_koperasi_paid')
            )
            ->groupBy(
                'drivers.id',
                'users.name',
                'drivers.tanggungan_koperasi'
            );

        if ($from && $to) {
            $query->whereBetween('trips.departure_date', [$from, $to]);
        }

        return $query->get();
    }


    public function carUsage(Request $request)
    {
        $from = $request->from ?? Carbon::now()->startOfMonth()->toDateString();
        $to = $request->to ?? Carbon::now()->endOfMonth()->toDateString();

        $trips = Trip::with(['car', 'driver.user'])
            ->whereBetween('departure_date', [$from, $to])
            ->orderBy('departure_date')
            ->get();

        return view('report.car-usage', compact('trips', 'from', 'to'));
    }

    public function printCarUsage(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $trips = Trip::with(['car', 'driver.user'])
            ->whereBetween('departure_date', [$from, $to])
            ->orderBy('departure_date')
            ->get();

        return view('report.print.car-usage', compact('trips', 'from', 'to'));
    }

}
