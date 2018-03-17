<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Post::class, 10)->create([
            'category_id' => '1',
            'user_id' => '1',
        ]);

        factory(App\Models\Post::class, 15)->create([
            'category_id' => '2',
            'user_id' => '1',
        ]);

        factory(App\Models\Post::class, 20)->create([
            'category_id' => '5',
            'user_id' => '5',
        ]);
    }
}
