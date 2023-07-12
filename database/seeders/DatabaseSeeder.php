<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Sift;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'foto_profile' => 'pekerja.png',
            'level' => 'admin'
        ]);

        \App\Models\Sift::factory()->create([
            'id_sift' => 'S-1',
            'name_sift' => 'SHIFT 1',
            'waktu_awal' => '00.00',
            'waktu_akhir' => '08.00',
        ]);

        \App\Models\Sift::factory()->create([
            'id_sift' => 'S-2',
            'name_sift' => 'SHIFT 2',
            'waktu_awal' => '08.00',
            'waktu_akhir' => '16.00',
        ]);

        \App\Models\Sift::factory()->create([
            'id_sift' => 'S-3',
            'name_sift' => 'SHIFT 3',
            'waktu_awal' => '16.00',
            'waktu_akhir' => '08.00',
        ]);


    }
}
