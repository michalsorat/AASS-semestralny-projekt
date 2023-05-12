<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role' => 'admin',
            'name' =>'admin',
            'last_name' =>'admin',
            'email' => 'admin@sellphone.sk',
            'street' => 'null',
            'street_nr' => 0,
            'city' => 'null',
            'psc' => 'null',
            'password' => Hash::make('1234')
        ]);
    }
}
