<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

// use number_format;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('staff')->insert([
            'name' => Str::random(10),
            'lastname' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Str::random(10),
            'street' => Str::random(10),
            'city' => Str::random(10),
            'phone' => '06'.random_int(00000000, 99999999),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
