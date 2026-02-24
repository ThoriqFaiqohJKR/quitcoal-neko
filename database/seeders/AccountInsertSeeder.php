<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AccountInsertSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('accounts')->insert([
            [
                'nama' => 'Super Admin',
                'email' => 'superadmin@mail.com',
                'password' => Hash::make('12345678'),
                'password_text' => '12345678',
                'role' => 'super_admin',
                'status' => 'Y',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('12345678'),
                'password_text' => '12345678',
                'role' => 'admin',
                'status' => 'Y',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}