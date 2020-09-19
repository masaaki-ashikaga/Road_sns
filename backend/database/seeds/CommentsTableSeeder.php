<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsTableSeeder extends Seeder
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
            Comment::create([
                'user_id' => $i,
                'post_id' => $i,
                'comment' => 'これはテストコメント' . $i . 'です。',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
