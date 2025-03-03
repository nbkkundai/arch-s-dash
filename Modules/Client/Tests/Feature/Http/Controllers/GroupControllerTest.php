<?php

namespace Modules\Client\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Modules\Client\Entities\Group;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;

/**
 * @see \Modules\Client\Http\Controllers\GroupController
 */
class GroupControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $this->setupFunctions();
        $user = User::first();

        $groups = Group::factory()->count(3)->create();

        $response = $this->actingAs($user)
                        ->get(route('groups.index'));

        $response->assertOk();
        $response->assertViewIs('client::group.index');
        $response->assertViewHas('groups');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $this->setupFunctions();
        $user = User::first();

        $response = $this->actingAs($user)
                        ->get(route('groups.create'));

        $response->assertOk();
        $response->assertViewIs('client::group.create');
    }


    /**
     * @test
     */
    public function wizard_displays_view()
    {
        $this->setupFunctions();
        $user = User::first();

        $response = $this->actingAs($user)
                        ->get('/client/groups/group-wizard-page-1');

        $response->assertOk();
        $response->assertViewIs('client::group.create-group-wizard');
    }


    /**
     * @test
     */
    public function user_can_add_members_later()
    {
        $this->setupFunctions();
        $user = User::first();

        $response = $this->actingAs($user)
                        ->get('/client/groups/group-wizard-page-3?group_id=1&loan_id=1');

        $response->assertOk();
        $response->assertViewIs('client::group.create-group-wizard');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->setupFunctions();
        $user = User::first();

        $this->assertActionUsesFormRequest(
            \Modules\Client\Http\Controllers\GroupController::class,
            'store',
            \Modules\Client\Http\Requests\GroupStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $this->setupFunctions();
        $user = User::first();

        $name = $this->faker->name;
        $name= strtoupper($name);
        $group_number = $this->faker->word;
        $zone_name = $this->faker->word;
        $zone_code = $this->faker->word;
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)
                        ->post(route('groups.store'), [
            'name' => $name,
            'zone_name' => $zone_name,
            'area_code' => '123',
            'area_officer' => 'marry',
            'zone_code' => $zone_code,
            'status_id' => 1,
            'file'=>$file,
            'loan_cycle'=>"6 months",
            'loan_term'=>"6 months",
            'loan_amount'=>"7000",
            'loan_status_id'=>"7",
            'disbursement_date'=>Carbon::now()
        ]);
        $response->assertSessionHasNoErrors();

        $groups = Group::query()
            ->where('name', $name)
            ->where('zone_name', $zone_name)
            ->where('zone_code', $zone_code)
            ->get();
        $this->assertCount(1, $groups);
        $group = $groups->first();

        $response->assertRedirect();
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $this->setupFunctions();
        $user = User::first();

        $group = Group::factory()->create();

        $response = $this->actingAs($user)
                        ->get(route('groups.edit', $group));

        $response->assertOk();
        $response->assertViewIs('client::group.edit');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->setupFunctions();
        $user = User::first();

        $this->assertActionUsesFormRequest(
            \Modules\Client\Http\Controllers\GroupController::class,
            'update',
            \Modules\Client\Http\Requests\GroupUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $this->setupFunctions();
        $user = User::first();
        
        $group = Group::factory()->create();
        $name = $this->faker->name;
        $name= strtoupper($name);
        $zone_name = $this->faker->word;
        $zone_code = $this->faker->word;
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($user)
                        ->put(route('groups.update', $group), [
            'name' => $name,
            'zone_name' => $zone_name,
            'zone_code' => $zone_code,
            'file'=>$file,
            'file_type'=>'Bank Statement',
            'disbursement_date'=>Carbon::now()
        ]);

        $group->refresh();

        $response->assertRedirect();

        $this->assertEquals($name, $group->name);
        $this->assertEquals($zone_name, $group->zone_name);
        $this->assertEquals($zone_code, $group->zone_code);
    }
}
