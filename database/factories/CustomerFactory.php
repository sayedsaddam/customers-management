<?php

namespace Database\Factories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'fatherName' => $this->faker->name(),
            'cnic' => $this->faker->uuid(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->e164PhoneNumber(),
            'dob' => $this->faker->date(),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'nokName' => $this->faker->name(),
            'nokCnic' => $this->faker->uuid(),
            'nokPhone' => $this->faker->e164PhoneNumber(),
            'nokEmail' => $this->faker->email(),
            'nokRelation' => $this->faker->word(),
            'status' => 'active',
            'user_id' => 1
        ];
    }
}
