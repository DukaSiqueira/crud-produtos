<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria um usuário para teste
        User::create([
            'name' => 'Liberfly',
            'email' => 'liberfly@example.com',
            'password' => Hash::make('liberfly123'),
        ]);
    }
}
