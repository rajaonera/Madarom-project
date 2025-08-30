<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('users')->insert([
            [
                'name'              => 'Super Admin',
                'email'             => 'madarom.compte10@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('MADAROM2025?'), 
                'remember_token'    => null,
                'role'              => 'admin',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
