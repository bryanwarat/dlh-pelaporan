<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'email@admin.com',
            'password' => Hash::make('ManadoHebat@123'),
            'level' => 1,
        ]);
        
        User::create([
            'name' => 'Administrator',
            'email' => 'adminsiperkasah',
            'password' => Hash::make('ManadoHebat@123'),
            'level' => 1,
        ]);
    }
}
