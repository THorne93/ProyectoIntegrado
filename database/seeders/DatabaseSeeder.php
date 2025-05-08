<?php

namespace Database\Seeders;
use Carbon\Traits\Timestamp;
use DateTime;
use App\Models\Exercise;
use App\Models\User;
use App\Models\School;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\UserRecordsFactory;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        School::factory(6)->create();
        User::factory(10)->create();
        $this->call([
            ExerciseSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            ChoiceSeeder::class
        ]);
        DB::table('users')->insert([
            [
                'password' =>Hash::make('1234'),
                'name' => 'Ad',
                'surname' => 'min',
                'email' => 'admin@admin.com',
                'school_id' =>null,
                'role' => 'Admin',
                'email_verified_at' => now(),
                'account_verified' => true,
                'remember_token' => Str::random(10),
            ]
        ]);

        $users = User::all()->count();
        $exercises = Exercise::all()->count();

        for ($i = 0; $i < 1000; $i++) {
            $exercise = fake()->numberBetween(1, $exercises);
            if (Exercise::find($exercise)->part != 4) {
                $topScore = 8;
            } else {
                $topScore = 12;
            }
            $timestamp = fake()->dateTimeBetween('-7 days', 'now');

            if ($timestamp->format('H') == '02') {
                $timestamp = $timestamp->modify('+1 hour');
            }
            DB::table('user_records')->insert([
                [
                    'user_id' => fake()->numberBetween(1, $users),
                    'exercise_id' => $exercise,
                    'score' => fake()->numberBetween(0, $topScore),
                    'time_spent' => fake()->numberBetween(200, 1000),
                    'timestamp' => $timestamp,
                ]
            ]);

        }
    }
}
