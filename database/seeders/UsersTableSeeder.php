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
            // //Admin
            // [
            //     'full_name'=>'Farhan Fahidur Rahim Admin',
            //     'username'=>'Admin',
            //     'email'=>'admin@gmail.com',
            //     'password'=>Hash::make('12345678'),
            //     'role'=>'admin',
            //     'status'=>'active',
            // ],

            // //Seller
            // [
            //     'full_name'=>'Farhan Fahidur Rahim Seller',
            //     'username'=>'Seller',
            //     'email'=>'seller@gmail.com',
            //     'password'=>Hash::make('12345678'),
            //     'role'=>'seller',
            //     'status'=>'active',
            // ],

            //Customer
            [
                'full_name'=>'Farhan Fahidur Rahim Customer',
                'username'=>'Customer',
                'email'=>'customer@gmail.com',
                'password'=>Hash::make('12345678'),
                'status'=>'active',
            ],
        ]);

        //Admin
        DB::table('admins')->insert([
            [
                'full_name'=>'Farhan Fahidur Rahim Admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('12345678'),
                'status'=>'active',
            ],
        ]);

        //Seller
        DB::table('sellers')->insert([
            [
                'full_name'=>'Farhan Fahidur Rahim Seller',
                'username'=>'Farhan',
                'email'=>'seller@gmail.com',
                'password'=>Hash::make('12345678'),
                'photo'=>'',
                'address'=>'Kishoreganj',
                'phone'=>'01675717825',
                'is_verified'=>0,
                'status'=>'active',
            ],
        ]);
    }
}
