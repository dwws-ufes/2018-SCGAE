<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! User::where('email', 'admin@mailinator.com')->first()) {
            User::create([
            'email' => 'admin@mailinator.com',
            'name' => 'Admin',
            'password' => Hash::make('123456'),
        ]);
        }
    }
}
