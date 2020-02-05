<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // 簡単ログイン用のデータ
    public function run()
    {
        DB::table('users')->insert([
           'name' => 'laravel',
           'email' => 'laravel@gmail.com',
           'password' => Hash::make('laravelpassword'),
        ]);
    }
}
