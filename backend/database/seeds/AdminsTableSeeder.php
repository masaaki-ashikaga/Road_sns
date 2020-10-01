<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'account_name' => 'test_admin',
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
