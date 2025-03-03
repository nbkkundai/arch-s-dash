<?php

namespace Modules\Admin\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Admin\Entities\Centre;
use App\Models\User;

class CentreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Centre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'code' => $this->faker->word,
            'address_line_1' => $this->faker->word,
            'address_line_2' => $this->faker->word,
            'city' => $this->faker->city,
            'province' => $this->faker->word,
            'creator_id' => User::factory(),
        ];
    }
}
