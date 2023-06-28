<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Room::all();
        return response($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*.name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $newRooms = [];

        foreach ($request->all() as $roomData) {
            $newRoom = new Room();
            $newRoom->room_type = $roomData['name'];
            $newRoom->save();

            $newRooms[] = $newRoom;
        }

        return response()->json([
            'message' => 'SUCCESS',
            'new room details' => $newRooms,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $room = Room::findOrFail($id);
            return response()->json([
                'message' => 'SUCCESS',
                'room details' => $room,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Room not found OR has been deleted'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $updateRoom = Room::findOrFail($id);
            $updateRoom->room_type = $request->name;
            $updateRoom->save();

            return response()->json([
                'message' => 'SUCCESS',
                'new room details' => $updateRoom,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Room not found OR has been deleted'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $deleteRoom = Room::findOrFail($id);
            $deleteRoom->delete();

            return response()->json([
                'message' => 'SUCCESS',
                'deleted room details' => $deleteRoom,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Room not found OR has been deleted'], 404);
        }
    }
}
