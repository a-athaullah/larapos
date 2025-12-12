<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        // $this->call(UsersTableSeeder::class);
        DB::table('payments')->insert([
            'name' => 'Cash',
        ]);
        DB::table('payments')->insert([
            'name' => 'QRIS',
        ]);
        DB::table('stores')->insert([
            'name' => 'first store',
            'description' => 'first merchant',
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'store_id' => 1,
        ]);
        
    }
}
