<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;
use Faker\Factory as Faker;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $topic1 = new Topic();
        $topic1->user_id = 1;
        $topic1->category_id = 1;
        $topic1->title = $faker->sentence();
        $topic1->photo = '1.jpg';
        $topic1->description = $faker->sentence();
        $topic1->status = 'approved';

        $topic2 = new Topic();
        $topic2->user_id = 1;
        $topic2->category_id = 3;
        $topic2->title = $faker->sentence();
        $topic2->photo = '2.jpg';
        $topic2->description = $faker->sentence();
        $topic2->status = 'approved';

        $topic3 = new Topic();
        $topic3->user_id = 2;
        $topic3->category_id = 2;
        $topic3->title = $faker->sentence();
        $topic3->photo = '3.jpg';
        $topic3->description = $faker->sentence();

        $topic4 = new Topic();
        $topic4->user_id = 2;
        $topic4->category_id = 4;
        $topic4->title = $faker->sentence();
        $topic4->photo = '4.jpg';
        $topic4->description = $faker->sentence();
        $topic4->status = 'approved';

        $topic5 = new Topic();
        $topic5->user_id = 1;
        $topic5->category_id = 5;
        $topic5->title = $faker->sentence();
        $topic5->photo = '5.jpg';
        $topic5->description = $faker->sentence();
        $topic2->status = 'refused';

        $topic6 = new Topic();
        $topic6->user_id = 2;
        $topic6->category_id = 1;
        $topic6->title = $faker->sentence();
        $topic6->photo = '6.jpg';
        $topic6->description = $faker->sentence();
        $topic6->status = 'approved';

        $topic7 = new Topic();
        $topic7->user_id = 2;
        $topic7->category_id = 3;
        $topic7->title = $faker->sentence();
        $topic7->photo = '7.jpg';
        $topic7->description = $faker->sentence();
        $topic2->status = 'refused';

        $topic1->save();
        $topic2->save();
        $topic3->save();
        $topic4->save();
        $topic5->save();
        $topic6->save();
        $topic7->save();
    }
}
