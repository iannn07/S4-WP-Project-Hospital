<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::find(auth()->user()->id);
        return view('admin.room_data.rd_create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newRoom = new Room();
        $newRoom->room_type = $request->name;
        $newRoom->save();

        return redirect()->route('admin.room.crud');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find(auth()->user()->id);
        $room = Room::findOrFail($id);
        return view('admin.room_data.rd_edit', compact('user', 'room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateRoom = Room::findOrFail($id);
        $updateRoom->room_type = $request->name;
        $updateRoom->save();

        return redirect()->route('admin.room.crud');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteRoom = Room::findOrFail($id);
        $deleteRoom->delete();

        return redirect()->route('admin.room.crud');
    }
}
