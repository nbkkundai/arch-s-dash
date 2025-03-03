<?php

namespace Modules\Client\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Admin\Entities\Centre;
use Modules\Client\Entities\Group;
use App\Models\User;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->name,
            'group_number' => $this->faker->word,
            'zone_name' => $this->faker->word,
            'zone_code' => $this->faker->word,
            'bank_account_name' => $this->faker->word,
            'bank_account_number' => $this->faker->word,
            'meeting_day' => $this->faker->word,
            'meeting_time' => $this->faker->word,
            'centre_id' => rand(1,25),//Centre::factory()->create()->id,
            'creator_id' => User::factory(),
        ];
    }
}
