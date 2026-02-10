<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin'
        ]);

        $user->assignRole('admin');


        // kalau belum ada user lain, bikin dulu biar user_id gak null
        User::factory()->count(20)->create([
            'role' => 'user'
        ]);

        // bikin 20 driver dummy
        Driver::factory()->count(20)->create()->each(function ($driver) {
            $driver->user->assignRole('user');
        });

    }
}
