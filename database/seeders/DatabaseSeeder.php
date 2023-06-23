<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->createUser('Liberfly User', 'libuser@example.com', 'liberfly123');
        $this->createUser('Liberfly Test', 'libtest@example.com', '1liber2fly3');

        $this->createTask('Trabalho faculdade', 'Trabalho de conclusão de curso');
        $this->createTask('Janta amigos', 'Jantar com amigos as 22:00');
        $this->createTask('Remédio', 'Tomar remédio as 12:00');
        $this->createTask('Alongamento', 'Alongamento depois de acordar');
        $this->createTask('Estudos', 'Estudar para a prova de matemática');
    }

    private function createUser(string $name, string $email, string $password): void
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }

    private function createTask(string $title, string $description): void
    {
        Task::create([
            'title' => $title,
            'description' => $description,
        ]);
    }
}
