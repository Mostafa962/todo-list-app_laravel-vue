<?php

namespace Modules\Item\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Item\Entities\Item\Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->word,
            'is_completed'  => false,
            // 'is_completed'  => $this->faker->randomElement([true, false]),
            // 'completed_at'  => $this->faker->dateTime(),
        ];
    }
}

