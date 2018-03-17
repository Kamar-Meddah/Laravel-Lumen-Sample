<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Comment::class, 2)->create([
            'post_id' => '1',
            'user_id' => '1'
        ]);

        factory(App\Models\Comment::class, 5)->create([
            'post_id' => '2',
            'user_id' => '3'
        ]);

        factory(App\Models\Comment::class, 4)->create([
            'post_id' => '2',
            'user_id' => '1'
        ]);
        factory(App\Models\Comment::class, 1)->create([
            'post_id' => '2',
            'user_id' => '2'
        ]);
    }
}
