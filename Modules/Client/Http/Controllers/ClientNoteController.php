<?php

namespace Modules\Client\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Client\Entities\ClientNote;
use Modules\Client\Http\Requests\ClientNoteStoreRequest;
use Modules\Client\Http\Requests\ClientNoteUpdateRequest;
use Auth;

class ClientNoteController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $client_notes = ClientNote::all();

        return view('client::client-note.index', compact('client_notes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('client::client-note.create');
    }

    /**
     * @param \Modules\Client\Http\Requests\ClientNoteStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientNoteStoreRequest $request)
    {
        $user = Auth::user();
        $client_note = ClientNote::create($request->validated());

        $client_note->user_id = $user->id;
        $client_note->save();

        return redirect()->back()->with('success','Note saved.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Modules\Client\Entities\ClientNote $client_note
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ClientNote $client_note)
    {
        return view('client::client-note.edit');
    }

    /**
     * @param \Modules\Client\Http\Requests\ClientNoteUpdateRequest $request
     * @param \Modules\Client\Entities\ClientNote $client_note
     * @return \Illuminate\Http\Response
     */
    public function update(ClientNoteUpdateRequest $request, ClientNote $client_note)
    {
        $client_note->update($request->validated());

        return redirect()->back()->with('success','Note saved.');
    }

    public function destroy(ClientNote $client_note)
    {
        if(!$user->hasAnyPermission(['delete notes'])) {
            abort(403);
        }
        $client_note->delete();
        return redirect()->action([ClientNoteController::class, 'index'])->with('success','client note deleted');
    }
}
