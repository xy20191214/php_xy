<?php

use Illuminate\Database\Seeder;

class BookTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\BookType::class, 1)->create()->each(function ($user) {
            $user->posts()->save(factory(App\BookType::class)->make());
        });
    }
}
