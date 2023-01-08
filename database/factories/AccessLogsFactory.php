<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AccessLogsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>"ROOT". rand(0, 500),
            'ip'=> fake()->ipv4(),
            'path'=> "",
            'a_time'=> fake()->unixTime($max = 'now')
        ];
    }
}
