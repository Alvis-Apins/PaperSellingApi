<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fields = ['software-development', 'security', 'accounting', 'engineering', 'office', 'education', 'governance', 'architecture'];

        return [
            'company' => fake()->company(),
            'work_field' => $fields[rand(0,7)],
            'company_size' => rand(1,3),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'address' => fake()->address()
        ];
    }
}
