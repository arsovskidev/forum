<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $general = new Category();
        $general->name = 'general';
        $entertainment = new Category();
        $entertainment->name = 'entertainment';
        $sports = new Category();
        $sports->name = 'sports';
        $movies = new Category();
        $movies->name = 'movies';
        $politics = new Category();
        $politics->name = 'politics';
        $cars = new Category();
        $cars->name = 'cars';

        $general->save();
        $entertainment->save();
        $sports->save();
        $movies->save();
        $politics->save();
        $cars->save();
    }
}
