<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Content;
use App\Models\RoomContent;
class RoomController extends Controller{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        // Retrieve all rooms with their associated contents through the pivot table
        $rooms = Room::with(['contents' => function ($query) {
            $query->select('contents.id', 'contents.name', 'room_contents.count');
        }])->get();

        // Format the response
        $formattedRooms = $rooms->map(function ($room) {
            return [
                'id' => $room->id,
                'room_number' => $room->room_number,
                'room_capacity' => $room->room_capacity,
                'room_status' => $room->room_status,
                'contents' => $room->contents->map(function ($content) {
                    return [
                        'content_id' => $content->id,
                        'theContent' => $content->name,
                        'count' => $content->pivot->count,
                    ];
                }),
            ];
        });

        // Return the data as JSON
        return response()->json($formattedRooms);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        // Validate the incoming request data
        $validated = $request->validate([
            'room_number'   => 'required|string',
            'room_capacity' => 'required|string',
            'room_status'  => 'required|string',
            'content'       => 'required|array', // Ensure content is an array
            'content.*.theContent' => 'required|string', // Validate that each content item has a name
            'content.*.count' => 'required|integer|min:1', // Validate count
        ]);

        // Create the room
        $room = Room::create([
            'room_number'   => $validated['room_number'],
            'room_capacity' => $validated['room_capacity'],
            'room_status'   => $validated['room_status'],
        ]);

        // Process the content array and save each item
        foreach ($validated['content'] as $row) {
            RoomContent::create([
                'room_id'    => $room->id,
                'content_id' => Content::where('name', $row['theContent'])->value('id'), // Retrieve content ID by name
                'count'      => $row['count'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Room and contents saved successfully']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id){
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'room_number'   => 'required',
            'room_capacity' => 'required',
            'room_status'   => 'required',
            'content'       => 'required|array', 
            'content.*.theContent' => 'required', 
            'content.*.count' => 'required|integer|min:1', 
        ]);

        $room = Room::findOrFail($id);

        $room->update([
            'room_number'   => $validated['room_number'],
            'room_capacity' => $validated['room_capacity'],
            'room_status'   => $validated['room_status'],
        ]);

        RoomContent::where('room_id', $room->id)->delete();

        foreach ($validated['content'] as $row) {
            RoomContent::create([
                'room_id'    => $room->id,
                'content_id' => Content::where('name', $row['theContent'])->value('id'), // Retrieve content ID by name
                'count'      => $row['count'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Room and contents updated successfully']);
    }

    public function destroy($id) {
        $room = Room::findOrFail($id);
        RoomContent::where('room_id', $room->id)->delete();
        $room->delete();

        return response()->json(['success' => true, 'message' => 'Room and contents deleted successfully']);
    }
}
