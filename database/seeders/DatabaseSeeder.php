<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Kode bawaan Laravel (Biarkan saja)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // ==========================================
        // TAMBAHKAN BAGIAN INI:
        // ==========================================
        $this->call([
            DepartmentAndKeywordSeeder::class,
        ]);
    }
}