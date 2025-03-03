<?php

namespace Modules\Client\Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Modules\Client\Entities\ClientNote;
use Tests\TestCase;
use App\Models\User;

/**
 * @see \Modules\Client\Http\Controllers\ClientNoteController
 */
class ClientNoteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $this->setupFunctions();
        $user = User::first();

        $clientNotes = ClientNote::factory()->count(3)->create();

        $response = $this->actingAs($user)
                        ->get(route('client-notes.index'));

        $response->assertOk();
        $response->assertViewIs('client::client-note.index');
        $response->assertViewHas('client_notes');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Client\Http\Controllers\ClientNoteController::class,
            'store',
            \Modules\Client\Http\Requests\ClientNoteStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $this->setupFunctions();
        $user = User::first();

        $text = $this->faker->text;

        $response = $this->actingAs($user)
                        ->from(route('client-notes.index'))
                        ->post(route('client-notes.store'), [
            'text' => $text,
            'client_id' => '1',
            'type' => 'personal'
        ]);

        $clientNotes = ClientNote::query()
            ->where('text', $text)
            ->get();
        $this->assertCount(1, $clientNotes);
        $clientNote = $clientNotes->first();

        $response->assertRedirect(route('client-notes.index'));
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \Modules\Client\Http\Controllers\ClientNoteController::class,
            'update',
            \Modules\Client\Http\Requests\ClientNoteUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $this->setupFunctions();
        $user = User::first();
        
        $clientNote = ClientNote::factory()->create();
        $text = $this->faker->text;

        $response = $this->actingAs($user)
                        ->from(route('client-notes.index'))
                        ->put(route('client-notes.update', $clientNote), [
            'text' => $text,
            'client_id' => '2',
            'type' => 'personal'
        ]);

        $clientNote->refresh();

        $response->assertSessionHasNoErrors();
        $this->assertEquals($clientNote->text,$text);
    }
}
