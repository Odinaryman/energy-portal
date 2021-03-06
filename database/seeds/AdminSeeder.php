<?php

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
        DB::table('users')->insert(
            array(
                'name' => 'Admin',
                'email' => 'info@sunhive.com',
                'password' => Hash::make('12csungcf'),
                'isAdmin' => true,
                'admin_level' => 2
            )
        );
    }
}
