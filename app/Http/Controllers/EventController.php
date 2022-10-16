<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use BaconQrCode\Renderer\RendererStyle\Fill;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $events = Event::latest()->get();
        // $events = Event::orderBy('start', 'desc')->get();
        $events = Event::orderBy('start', 'asc')->get();

        return view('events.index')->with(compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $event = new Event($request->all());
        $event->user_id = $request->user()->id;
        // dd($event);
        try {
            $event->save();
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors($th->getMessage());
        }

        return redirect()->route('events.show', $event)->with('notice', '新しいイベントが発生しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show')->with(compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        // この処理をモデルでアクセサ
        // $start_array = explode(' ', $event->start);
        // $end_array = explode(' ', $event->end);
        
        // $event->start_date = $start_array[0];
        // $event->start_time = $start_array[1];
        // $event->end_date = $start_array[0];
        // $event->end_time = $start_array[1];

        return view('events.edit')->with(compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->fill($request->all());
        // dd($event);
        try {
            $event->save();
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors($th->getMessage());
        }

        return redirect()->route('events.show', $event)->with('notice', '編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        try {
            $event->delete();
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors($th->getMessage());
        }

        return redirect()
                ->route('events.index')
                ->with('notice', 'イベントを削除しました');
    }
}
