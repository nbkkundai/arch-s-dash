<?php

namespace Modules\Client\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Modules\Client\Entities\Client;
use Modules\Loan\Entities\Loan;

/**
 * @see \Modules\Client\Http\Controllers\ClientController
 */
class ClientControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $this->setupFunctions();

        $user = User::first();

        $clients = Client::factory()->count(3)->create();

        $response = $this->actingAs($user)
                        ->get(route('clients.index'));

        $response->assertOk();
        $response->assertViewIs('client::client.index');
        $response->assertViewHas('clients');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $this->setupFunctions();
        $user = User::first();

        $response = $this->actingAs($user)
                        ->get(route('clients.create'));

        $response->assertOk();
        $response->assertViewIs('client::client.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Client\Http\Controllers\ClientController::class,
            'store',
            \Modules\Client\Http\Requests\ClientStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $this->setupFunctions();
        $user = User::first();

        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $id_number = '9105285062087';//'9212105322087';
        $file = UploadedFile::fake()->image('avatar.jpg');

        $loan = Loan::factory()->create(['loan_amount'=>'20000']);

        $response = $this->actingAs($user)
                        ->post(route('clients.store'), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'initials' => "RB",
            'id_number' => $id_number,
            'group_id' => 1,
            'centre_id' => 1,
            'file' => $file,
            'loan_id' => $loan->id,
            'loan_fraction' => "1000",
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $clients = Client::query()
            ->where('initials', "RB")
            ->where('last_name', $last_name)
            ->where('id_number', $id_number)
            ->get();
        $this->assertCount(1, $clients);
        $client = $clients->first();

        $response->assertRedirect();
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $this->setupFunctions();
        $user = User::first();

        $client = Client::factory()->create();

        $response = $this->actingAs($user)
                        ->get(route('clients.edit', $client));

        $response->assertOk();
        $response->assertViewIs('client::client.edit');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Client\Http\Controllers\ClientController::class,
            'update',
            \Modules\Client\Http\Requests\ClientUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $this->setupFunctions();
        $user = User::first();

        $client = Client::factory()->create();
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $id_number = '9105285062087';//'9212105322087';

        $response = $this->actingAs($user)
                        ->put(route('clients.update', $client), [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'initials' => "RB",
            'id_number' => $id_number,
            'group_id' => 1,
        ]);
        $response->assertSessionHasNoErrors();
        $client->refresh();

        $response->assertRedirect();

        $this->assertEquals($first_name, $client->first_name);
        $this->assertEquals($last_name, $client->last_name);
        $this->assertEquals($id_number, $client->id_number);
    }
}
