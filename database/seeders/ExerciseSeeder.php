<?php

namespace Database\Seeders;
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
            ["title" => "Why we need to play", "part" => "1", "created_at" => now()],
            ["title" => "Home and abroad", "part" => "1", "created_at" => now()],
            ["title" => "New words for a dictionary", "part" => "1", "created_at" => now()],
            ["title" => "Memory", "part" => "1", "created_at" => now()],
            ["title" => "Holidays at home", "part" => "1", "created_at" => now()],

            // Part 2 exercises
            ["title" => "A bicycle you can fold up", "part" => "2", "created_at" => now()],
            ["title" => "An Irish cookery school", "part" => "2", "created_at" => now()],
            ["title" => "Animal Communication", "part" => "2", "created_at" => now()],
            ["title" => "Visit to a sweets factory", "part" => "2", "created_at" => now()],
            ["title" => "A short history of tattooing", "part" => "2", "created_at" => now()],

            // Part 3 exercises
            ["title" => "Tea", "part" => "3", "created_at" => now()],
            ["title" => "Running speed", "part" => "3", "created_at" => now()],
            ["title" => "Cycling", "part" => "3", "created_at" => now()],
            ["title" => "Job interviews", "part" => "3", "created_at" => now()],
            ["title" => "Brain games", "part" => "3", "created_at" => now()],

            // Part 4 exercises
            ["title" => "Use of English part 4 - 1", "part" => "4", "created_at" => now()],
            ["title" => "Use of English part 4 - 2", "part" => "4", "created_at" => now()],
            ["title" => "Use of English part 4 - 3", "part" => "4", "created_at" => now()],
            ["title" => "Use of English part 4 - 4", "part" => "4", "created_at" => now()],
            ["title" => "Use of English part 4 - 5", "part" => "4", "created_at" => now()],


            //More exerises added 28/05/25
            ["title" => "Fingernails growing faster", "part" => "1", "created_at" => now()],
            ["title" => "The sticking plaster", "part" => "1", "created_at" => now()],
            ["title" => "The joy of picnics", "part" => "1", "created_at" => now()],
            ["title" => "Email overload", "part" => "1", "created_at" => now()],
            ["title" => "St Lucia", "part" => "1", "created_at" => now()],

            ["title" => "How the Tour de France began", "part" => "2", "created_at" => now()],
            ["title" => "Diving in the Red Sea", "part" => "2", "created_at" => now()],
            ["title" => "Safe camping", "part" => "2", "created_at" => now()],
            ["title" => "Using mobile phones", "part" => "2", "created_at" => now()],
            ["title" => "The Northern Lights", "part" => "2", "created_at" => now()],

            ["title" => "The city of Miami", "part" => "3", "created_at" => now()],
            ["title" => "Hot-air balloons", "part" => "3", "created_at" => now()],
            ["title" => "A brief history of surfing", "part" => "3", "created_at" => now()],
            ["title" => "112 pets", "part" => "3", "created_at" => now()],
            ["title" => "Sudden storm", "part" => "3", "created_at" => now()],

            ["title" => "Use of English part 4 - 6", "part" => "4", "created_at" => now()],
            ["title" => "Use of english part 4 - 7", "part" => "4", "created_at" => now()],
            ["title" => "Use of english part 4 - 8", "part" => "4", "created_at" => now()],
            ["title" => "Use of english part 4 - 9", "part" => "4", "created_at" => now()],
            ["title" => "Use of english part 4 - 10", "part" => "4", "created_at" => now()],
        ]);
    }
}
