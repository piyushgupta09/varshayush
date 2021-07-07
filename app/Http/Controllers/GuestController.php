<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guests = Guest::all();
        return view('app.guests.index', [
            'guests' => $guests->reverse()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.guests.create', [
            'events' => Event::upcoming()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guest = new Guest();
        $guest->name = $request->name;
        $guest->relation = $request->relation;
        $guest->adults = $request->adults;
        $guest->kids = ($request->kids) ?? '0';
        $guest->address = $request->address;
        $guest->note = $request->note;
        $guest->travelby = $request->travelby;
        $guest->contact = $request->contact;
        $guest->number = $request->number;
        $guest->senior = $request->senior;
        $guest->image = ($request->image) ?? Guest::defaultImage();
        $guest->save();
        $request->guest = $guest->id;
        $this->persist($request);
        return redirect()->route('guests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function show(Guest $guest)
    {
        return view('app.guests.show', compact('guest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        return view('app.guests.edit', compact('guest'));
    }

    /**
     * Show the form for inviting guest to upcoming events.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function invite(Request $request, Guest $guest)
    {
        return view('app.guests.invite', [
            'guest' => $guest,
            'events' => Event::upcoming()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guest $guest)
    {
        $guest->name = $request->name;
        $guest->relation = $request->relation;
        $guest->adults = $request->adults;
        $guest->kids = $request->kids;
        $guest->address = $request->address;
        $guest->note = $request->note;
        $guest->travelby = $request->travelby;
        $guest->contact = $request->contact;
        $guest->number = $request->number;
        $guest->senior = $request->senior;
        if (Guest::defaultImage() != $guest->image) {
            $guest->image = $request->image;
        }
        $guest->update();
        return back();
    }

    /**
     * Create new entry in event_guest table.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function persist(Request $request)
    {
        $guest = Guest::where('id', $request->guest)->get()->first();

        if ($request->nature == 'cancel-invite') {
            $event = Event::where('id', $request->event)->get()->first();
            $event->guests()->detach($guest);
            return back();
        }

        if ($request->nature == 'make-invite') {
            foreach ($request->events as $eventId) {
                $event = Event::where('id', $eventId)->get()->first();
                $event->guests()->attach($guest);
            }
            return redirect()->route('guests.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return back();
    }

}
