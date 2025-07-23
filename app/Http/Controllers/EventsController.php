<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function allEvents()
    {
        $events = Event::orderBy('id', 'desc')->get();

        if ($events->isEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'No events found',
                'data' => [],
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Events fetched successfully',
            'data' => $events,
        ], 200);
    }

    public function getEvents(Request $request, $id)
    {
        try {
            $event = Event::findOrFail($id);

            return response()->json([
                'message' => 'Event fetched successfully',
                'data' => $event
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Event not found',
                'error' => true
            ], 404);
        }
    }

    public function createEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'ticket_price' => 'required|numeric',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        try {
            $event = new Event();
            $event->title = $request->title;
            $event->ticket_price = $request->ticket_price;
            $event->description = $request->description;
            $event->start_time = $request->start_time;
            $event->end_time = $request->end_time;
            $event->save();

            return response()->json([
                'message' => 'Insert successfully',
                'data' => $event,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error creating event',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateEvent(Request $request, $id)   // <‑‑ note $id here
    {
        // 1️⃣ Validate only the fields coming in the body
        $request->validate([
            'title' => 'required|string',
            'ticket_price' => 'required|numeric',
            'description' => 'required|string',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',
        ]);

        // 2️⃣ Find the event or return 404
        $event = Event::findOrFail($id);

        // 3️⃣ Update the event (only the validated keys)
        $event->update($request->only([
            'title',
            'ticket_price',
            'description',
            'start_time',
            'end_time',
        ]));

        // 4️⃣ Return JSON response
        return response()->json([
            'message' => 'Update successful',
            'data' => $event,
        ]);

    }

    // delete single event
    public function deleteEvent(Request $request, $id)
    {
        Event::destroy($id);

        return response()->json([
            'message' => 'delete successfully',
            'data' => ''
        ]);
    }
}
