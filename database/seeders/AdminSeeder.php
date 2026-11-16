<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\{User, Profile, Role};

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $profile = Profile::create([
            'alamat' => $faker->address,
            'umur'   => $faker->numberBetween(20, 50),
            'bio'    => 'administrator',
        ]);

        $adminRole = Role::where('name', 'admin')->first();

        User::create([
            'name'              => 'admin',
            'email'             => 'admin@example.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('12345678'),
            'remember_token'    => Str::random(10),
            'role_id'           => $adminRole->id,
            'profile_id'        => $profile->id,
        ]);
    }
}