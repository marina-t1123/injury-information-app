<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AthleteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'team' => $this->faker->company(),
            'event' => '柔道',
            'event_detail' => '57Kg級',
            'career' => '2015年、〇〇大学卒業。2015年〜三井住友海上火災保険所属。'
        ];
    }
}
