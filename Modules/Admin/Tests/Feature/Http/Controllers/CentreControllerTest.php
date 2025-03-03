<?php

namespace Modules\Admin\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;
use App\Models\User;
use Modules\Admin\Entities\Centre;

/**
 * @see \Modules\Admin\Http\Controllers\CentreController
 */
class CentreControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $this->setupFunctions();
        $user = User::first();

        $centres = Centre::factory()->count(3)->create();

        $response = $this->actingAs($user)
                        ->get(route('centres.index'));

        $response->assertOk();
        $response->assertViewIs('admin::centre.index');
        $response->assertViewHas('centres');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $this->setupFunctions();
        $user = User::first();

        $response = $this->actingAs($user)
                        ->get(route('centres.create'));

        $response->assertOk();
        $response->assertViewIs('admin::centre.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Admin\Http\Controllers\CentreController::class,
            'store',
            \Modules\Admin\Http\Requests\CentreStoreRequest::class
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

        $response = $this->actingAs($user)
                        ->post(route('centres.store'), [
                            'name' => $name,
                        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/admin/centres');

        $centres = Centre::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $centres);
        $centre = $centres->first();

    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $this->setupFunctions();

        $user = User::first();

        $centre = Centre::factory()->create();

        $response = $this->actingAs($user)
                        ->get(route('centres.edit', $centre));

        $response->assertOk();
        $response->assertViewIs('admin::centre.edit');
    }

    public function test_show_centre_page()
    {
        $this->setupFunctions();

        $user = User::first();
        $centre = Centre::first();

        $response = $this->actingAs($user)
                            ->get('/admin/centres/'.$centre->slug);

        $response->assertStatus(200);
        $response->assertSee('centre');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Admin\Http\Controllers\CentreController::class,
            'update',
            \Modules\Admin\Http\Requests\CentreStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $this->setupFunctions();

        $user = User::first();
        
        $centre = Centre::factory()->create();
        $name = $this->faker->name;
        $name= strtoupper($name);

        $response = $this->actingAs($user)
                        ->put(route('centres.update', $centre), [
                            'name' => $name,
                        ]);

        $centre->refresh();

        $response->assertRedirect(route('centres.index'));

        $this->assertEquals($name, $centre->name);
    }
}
