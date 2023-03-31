<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            //Admin
            [
                'full_name'=>'Farhan Fahidur Rahim Admin',
                'username'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('12345678'),
                'role'=>'admin',
                'status'=>'active',
            ],

            //Vendor
            [
                'full_name'=>'Farhan Fahidur Rahim Vendor',
                'username'=>'Vendor',
                'email'=>'vendor@gmail.com',
                'password'=>Hash::make('12345678'),
                'role'=>'vendor',
                'status'=>'active',
            ],

            //Customer
            [
                'full_name'=>'Farhan Fahidur Rahim Customer',
                'username'=>'Customer',
                'email'=>'customer@gmail.com',
                'password'=>Hash::make('12345678'),
                'role'=>'customer',
                'status'=>'active',
            ],
        ]);
    }
}
