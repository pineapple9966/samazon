<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('admins')->insert([
            ['created_at' => \Carbon\Carbon::now(), 'email' => 'admin@example.com', 'password' => Hash::make('samazon12345')]
        ]);
    }
}
