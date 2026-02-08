<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        return view('driver.index', compact('drivers'));
    }

    public function create()
    {
        return view('driver.create');
    }

    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('driver.edit', compact('driver'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',

            'name' => 'required|string|max:255',
            'persentase_hasil' => 'required|integer|in:40,45,50',
            'tanggungan_koperasi' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($validated) {

            $user = User::create([
                'name' => $validated['user_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'user',
            ]);

            Driver::create([
                'user_id' => $user->id,
                'name' => $validated['name'],
                'persentase_hasil' => $validated['persentase_hasil'],
                'tanggungan_koperasi' => $validated['tanggungan_koperasi'],
            ]);
        });

        return redirect()->route('driver.index')->with('success', 'Driver created successfully.');
    }



    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $driver->user->id,
            'password' => 'nullable|string|min:6',

            'name' => 'required|string|max:255',
            'persentase_hasil' => 'required|integer|in:40,45,50',
            'tanggungan_koperasi' => 'required|integer|min:0',
        ]);

        // update user
        $driver->user->name = $validated['user_name'];
        $driver->user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $driver->user->password = Hash::make($validated['password']);
        }

        $driver->user->save();

        // update driver
        $driver->update([
            'name' => $validated['name'],
            'persentase_hasil' => $validated['persentase_hasil'],
            'tanggungan_koperasi' => $validated['tanggungan_koperasi'],
        ]);

        return redirect()->route('driver.index')->with('success', 'Driver berhasil diupdate.');
    }

    public function delete($id)
    {
        DB::transaction(function () use ($id) {
            $driver = Driver::findOrFail($id);

            // ambil user_id sebelum driver dihapus
            $userId = $driver->user_id;

            // hapus driver dulu
            $driver->delete();

            // hapus usernya juga (kalau memang user ini khusus driver)
            User::where('id', $userId)->delete();
        });

        return redirect()->route('driver.index')->with('success', 'Driver berhasil dihapus.');
    }

}
