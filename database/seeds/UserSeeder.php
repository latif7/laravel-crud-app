<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hasUser = \App\User::get();
        if (!count($hasUser)) {

            $now = \Carbon\Carbon::now();

            \App\User::insert([
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => bcrypt("12345678"),
                "role" =>"Admin",
                "status" =>"Active",
                'created_at' => $now,
                'updated_at' => $now
            ]);

        }
    }
}
