<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* take only organizer from user autenticated */
        $organizers = Organizer::where('user_id', '=', auth()->user()->id)->get();

        return view('organizers.index', compact('organizers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizer = new Organizer();
        return view('organizers.create', compact('organizer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Validation */
        $request->validate(
            [
                'expire' => 'required|date',
                'description' => 'nullable|string',
            ],
            [
                'required' => 'Il campo :attribute è obbligatorio',
            ]
        );

        $data = $request->all();

        /* user id authenticated */
        $data['user_id'] = auth()->user()->id;

        /* Checkbox control */
        if (isset($data['notification'])) $data['notification'] = 1;

        /* Carbon formatter */
        $carbon = new Carbon($data['expire']);

        /* Reminder creation */
        $data['reminder'] = $carbon->subHour();

        $organizer = Organizer::create($data);

        return redirect()->route('home.organizer.index')->with('message', "Appuntamento creato");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function show(Organizer $organizer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function edit(Organizer $organizer)
    {
        /* Convert datetime for input*/
        $organizer->expire = substr_replace($organizer->expire, 'T', 10, 1);

        /* dd($organizer->expire); */

        return view('organizers.edit', compact('organizer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organizer $organizer)
    {
        /* Validation */
        $request->validate(
            [
                'expire' => 'required|date',
                'description' => 'nullable|string',
            ],
            [
                'required' => 'Il campo :attribute è obbligatorio',
            ]
        );

        $data = $request->all();

        /* Checkbox control */
        if (isset($data['notification'])) $data['notification'] = 1;
        else $data['notification'] = 0;

        /* Convert datetime for input*/
        $organizer->expire = substr_replace($organizer->expire, 'T', 10, 1);

        /* if expire change, change reminder */
        if ($organizer->expire != $data['expire']) {
            /* Carbon formatter */
            $carbon = new Carbon($data['expire']);

            /* Reminder creation */
            $data['reminder'] = $carbon->subHour();
        }

        $organizer->update($data);

        return redirect()->route('home.organizer.index')->with('message', "Appuntamento modificato");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organizer $organizer)
    {

        $organizer->delete();

        return redirect()->route('home.organizer.index')->with('message', "Appuntamento eliminato");
    }
}
