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
        factory(App\Model\Book\BookType::class, 10)->create();
    }
}
