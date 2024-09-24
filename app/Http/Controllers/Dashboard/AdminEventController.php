<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Streamer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminEventController extends Controller
{
    public function index()
    {
        return view('dashboard.events.index', [
            'events' => Event::with('streamers')->orderBy('date')->get()
        ]);
    }

    public function create()
    {
        return view('dashboard.events.create', [
            'streamers' => Streamer::orderBy('login')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $streamers = Streamer::find($request->get('streamers'));
        $validated = $request->validate([
            'title' => ['required'],
            'date' => ['required', 'date'],
            'description' => ['nullable'],
        ]);
        $validated['slug'] = Str::slug($validated['title']);

        Event::create($validated)->streamers()->attach($streamers);
        return redirect(route('events.index'))->with('success', 'Nouvel évènement créé.');
    }

    public function edit(Event $event)
    {
        return view('dashboard.events.edit', [
            'event' => $event,
            'streamers' => Streamer::orderBy('login')->get(),
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $streamers = Streamer::find($request->get('streamers'));
        $validated = $request->validate([
            'title' => ['required'],
            'date' => ['required', 'date'],
            'description' => ['nullable'],
        ]);
        $validated['slug'] = Str::slug($validated['title']);

        $event->update($validated);
        $event->streamers()->detach(Streamer::all()->get('ids'));
        $event->streamers()->attach($streamers);

        return redirect(route('events.index'))->with('success', 'Modifications enregistrées');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('danger', "Évènement supprimé.");
    }
}
