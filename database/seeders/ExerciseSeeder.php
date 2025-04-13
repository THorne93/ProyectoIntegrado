<?php

namespace Database\Seeders;

use Database\Factories\ExerciseFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exercise;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exercise::insert([
            // Part 1 exercises
            ["title"=>"Why we need to play","part"=>"1","created_at"=>now()],

            // Part 2 exercises
            ["title"=>"A bicycle you can fold up","part"=>"2","created_at"=>now()],
            ["title"=>"An Irish cookery school","part"=>"2","created_at"=>now()],
            ["title"=>"Animal Communication","part"=>"2","created_at"=>now()],
            ["title"=>"Visit to a sweets factory","part"=>"2","created_at"=>now()],
            ["title"=>"A short history of tattooing","part"=>"2","created_at"=>now()],

            // Part 3 exercises
            ["title"=>"Tea","part"=>"3","created_at"=>now()],

            // Part 4 exercises
            ["title"=>"Use of English part 4 - 1","part"=>"4","created_at"=>now()],
        ]);
    }
}
