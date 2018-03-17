<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Image::class,5)->create([
            'post_id' => 1
        ]);

        factory(App\Models\Image::class,2)->create([
            'post_id' => 3
        ]);
    }
}
