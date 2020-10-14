<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++)
        {
            User::create([
                'account_name' => 'user_name' . $i,
                'name' => 'test_user' . $i,
                'profile_image' => 'test_user.jpg',
                'email' => 'test' . $i . '@gmail.com',
                'text' => 'テストユーザー' . $i . 'です。',
                'admin' => 0,
                'password' => Hash::make('12345678'),
            ]);
        }
        User::create([
            'account_name' => 'admin_user',
            'name' => 'test_admin',
            'profile_image' => 'test_admin.jpg',
            'email' => 'admin@gmail.com',
            'text' => '管理者ユーザーです。',
            'admin' => 1,
            'password' => Hash::make('12345678'),
        ]);
    }
}
