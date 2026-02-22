<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Payment;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::all();
        return view('deposit.index', compact('deposits'));
    }
    public function edit($id)
    {
        $deposit = Deposit::findOrFail($id);
        return view('deposit.edit', compact('deposit'));
    }

    public function store_payment(Request $request, $id)
    {
        $deposit = Deposit::findOrFail($id);

        // Validasi
        $request->validate([
            'payment_method' => 'required|in:cash,transfer',

            'attachment_nota' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // wajib kalau transfer
            'attachment_transfer' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Kalau transfer, wajib ada attachment_transfer
        if ($request->payment_method === 'transfer') {
            $request->validate([
                'attachment_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);
        }

        // Ambil payment lama kalau ada (biar bisa update)
        $payment = Payment::where('deposit_id', $deposit->id)->first();

        // Path file lama (kalau update)
        $oldNota = $payment?->attachment_nota;
        $oldTransfer = $payment?->attachment_transfer;

        // Upload file baru jika ada
        $notaPath = $oldNota;
        if ($request->hasFile('attachment_nota')) {
            $notaPath = $request->file('attachment_nota')->store('payments/nota', 'public');

            // hapus file lama
            if ($oldNota) {
                Storage::disk('public')->delete($oldNota);
            }
        }

        $transferPath = $oldTransfer;
        if ($request->hasFile('attachment_transfer')) {
            $transferPath = $request->file('attachment_transfer')->store('payments/transfer', 'public');

            // hapus file lama
            if ($oldTransfer) {
                Storage::disk('public')->delete($oldTransfer);
            }
        }

        // Kalau payment method cash, bukti transfer harus kosong
        if ($request->payment_method === 'cash') {
            // hapus file transfer lama kalau ada
            if ($oldTransfer) {
                Storage::disk('public')->delete($oldTransfer);
            }
            $transferPath = null;
        }

        // Simpan / update payment
        Payment::updateOrCreate(
            ['deposit_id' => $deposit->id],
            [
                'payment_method' => $request->payment_method,
                'attachment_nota' => $notaPath,
                'attachment_transfer' => $transferPath,
                'status' => 'lunas', // default
            ]
        );

        return redirect()
            ->route('deposit.edit', ['id' => $deposit->id, 'mode' => 'view'])
            ->with('success', 'Pembayaran berhasil disimpan.');

    }



}
