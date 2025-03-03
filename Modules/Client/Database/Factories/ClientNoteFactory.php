<?php

namespace Modules\Client\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Client\Entities\Client;
use Modules\Client\Entities\ClientNote;
use App\Models\User;

class ClientNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientNote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->text,
            'type' => $this->faker->word,
            'client_id' => Client::factory(),
            'user_id' => User::factory(),
        ];
    }
}
