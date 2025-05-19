<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menambahkan role admin dan user ke tabel roles jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['permissions' => json_encode(config('permissions'))]);
        $userRole = Role::firstOrCreate(['name' => 'user'], ['permissions' => json_encode([])]);

        // Membuat user admin
        User::factory()->create([
            'name' => 'Admin User',
            'role_id' => $adminRole->id, // role_id untuk admin
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Membuat user biasa
        User::factory()->create([
            'name' => 'Regular User',
            'role_id' => $userRole->id, // role_id untuk user biasa
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
