<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Category::class,5)->create()->each(function ($u){
            $u->posts()->save(factory(App\Models\Post::class)->make());
        });
    }
}
