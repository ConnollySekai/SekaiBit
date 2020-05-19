<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=0; $i < 10; $i++) {
            DB::table('tags')->insert([
                'tag_name' => $faker->colorName,
                'tag_count' => $faker->numberBetween(1,20),
            ]);
        }
    }
}
