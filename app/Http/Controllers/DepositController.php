<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index(){
        $deposits = Deposit::all();
        return view('deposit.index', compact('deposits'));
    }
}
