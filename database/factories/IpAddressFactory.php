<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IpAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => auth()->user()->id ?? 1,
            'label' => $this->faker->word(),
            'ip_address' => $this->faker->ipv4(),
            'created_by' => auth()->user()->id ?? 1,
        ];
    }
}
