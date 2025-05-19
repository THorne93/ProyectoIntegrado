<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Normalizer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{


    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    function removeAccents($string)
    {
        // Use Normalizer if available
        if (class_exists('Normalizer')) {
            // Normalize to decomposed form (base + accent)
            $string = Normalizer::normalize($string, Normalizer::FORM_D);
            // Remove combining marks (accents)
            return preg_replace('/\p{Mn}/u', '', $string);
        } else {
            // Fallback to iconv (may produce unwanted characters like ')
            $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
            // Remove any stray non-alphanumeric characters (like apostrophes)
            return preg_replace('/[^A-Za-z0-9@.]/', '', $string);
        }
    }
    public function definition(): array
    {
        $possible_schools = [1, 2, 3, 4, 5, null];
        $name = fake('es_ES')->firstName();
        $surname = fake('es_ES')->lastName();
        $email = $this->removeAccents(strtolower(str_replace(' ', '', $name . '.' . $surname . '@example.com')));

        return [
            'password' => static::$password ??= Hash::make('1234'),
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'school_id' => $possible_schools[fake()->numberBetween(0, 5)],
            'role' => 'Student',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'set_exercise' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
