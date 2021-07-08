<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use Faker\Factory as Faker;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $comment1 = new Comment();
        $comment1->user_id = 1;
        $comment1->topic_id = 1;
        $comment1->content = $faker->sentence();

        $comment2 = new Comment();
        $comment2->user_id = 2;
        $comment2->topic_id = 1;
        $comment2->content = $faker->sentence();

        $comment3 = new Comment();
        $comment3->user_id = 1;
        $comment3->topic_id = 2;
        $comment3->content = $faker->sentence();

        $comment1->save();
        $comment2->save();
        $comment3->save();
    }
}
