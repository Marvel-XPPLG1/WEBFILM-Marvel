<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 10 user biasa (role_id 1 diatur di UserFactory)
        \App\Models\User::factory(10)->create();
    }
}