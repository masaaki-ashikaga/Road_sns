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
                'password' => Hash::make('12345678'),
            ]);
        }
    }
}
