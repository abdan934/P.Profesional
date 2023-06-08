<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\models\user;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\User::factory()->create([
            'username' => 'admin',
            'password' => md5('admin123'),
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
            'level' => 'admin'
        ]);
    }
}
