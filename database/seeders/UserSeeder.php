<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@teste.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Operador User',
            'email' => 'operador@teste.com',
            'password' => Hash::make('password'),
            'role' => 'operador',
        ]);

        User::create([
            'name' => 'Usuário Comum',
            'email' => 'usuario@teste.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);
    }
}
