<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("accounts")->insert([
            'nama' => 'Admin',
            'email' => 'quitcoal@auriga.or.id',
            'password' => Hash::make('123123'),
            'password_text' => '123123',
            'role' => 'admin',
            'status' => 'Y',
        ]);
    }
}
