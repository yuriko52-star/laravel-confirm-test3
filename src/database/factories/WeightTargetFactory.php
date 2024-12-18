<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\WeightTarget;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightTargetFactory extends Factory
{
     protected $model = WeightTarget::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>User::inRandomOrder()->first()->id,
            'target_weight'=> $this->faker->randomFloat(1,40.0,70.0),
        ];
    }
}
