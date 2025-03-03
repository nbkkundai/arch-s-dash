<?php

namespace Modules\Client\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Admin\Entities\Centre;
use Modules\Client\Entities\Client;
use App\Models\User;
use Carbon\Carbon;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;

        return [
            'code' => Str::uuid(),
            'slug' => $first_name.'-'.$last_name,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'id_number' => Str::uuid(),
            'date_of_birth' => $this->faker->date(),
            'sex' => $this->faker->word,
            'marital_status' => $this->faker->word,
            'phone' => $this->faker->phoneNumber,
            'address_line_1' => $this->faker->word,
            'address_line_2' => $this->faker->word,
            'city' => $this->faker->city,
            'province' => $this->faker->word,
            'address_code' => $this->faker->word,
            'initials' => $this->faker->word,
            'postal_city' => $this->faker->word,
            'postal_province' => $this->faker->word,
            'postal_code' => $this->faker->postcode,
            'country_id' => 1,
            'centre_id' => rand(1,25),//Centre::factory(),
            'creator_id' => User::factory(),
            'agreed_to_privacy_policy' => $this->faker->boolean,
            'created_at' => Carbon::now()->subDays(rand(0,150)),
        ];
    }
}
