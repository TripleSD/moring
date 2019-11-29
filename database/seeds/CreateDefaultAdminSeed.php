<?php

use Illuminate\Database\Seeder;

class CreateDefaultAdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@localhost',
            'password' => '$2y$10$jjQzp/Ffq.KPX0xTMG5xm.CcC9IPwL8CAey/PQ3HKeYW8uXt3cwj2',
        ]);
    }
}
