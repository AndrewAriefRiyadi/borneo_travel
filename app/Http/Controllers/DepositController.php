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
    public function edit($id){
        $deposit = Deposit::findOrFail($id);
        return view('deposit.edit', compact('deposit'));
    }

    

}
