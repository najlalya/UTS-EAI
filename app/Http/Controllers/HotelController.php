<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return response()->json($hotels);
    }

    public function show($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel not found'], 404);
        }
        return response()->json($hotel);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'city_location' => 'required',
            'room_price' => 'required|numeric',
        ]);

        $hotel = Hotel::create([
            'name' => $validatedData['name'],
            'city_location' => $validatedData['city_location'],
            'room_price' => $validatedData['room_price'],
        ]);

        return response()->json($hotel, 201);
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required',
            'city_location' => 'required',
            'room_price' => 'required|numeric',
        ]);

        $hotel->name = $validatedData['name'];
        $hotel->city_location = $validatedData['city_location'];
        $hotel->room_price = $validatedData['room_price'];
        $hotel->save();

        return response()->json($hotel);
    }


    public function destroy($id)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['message' => 'Hotel not found'], 404);
        }

        $hotel->delete();

        return response()->json(['message' => 'Hotel deleted']);
    }

    public function search(Request $request)
    {
        $keyword = $request->query('location');
        $hotels = Hotel::where('city_location', 'LIKE', "%$keyword%")
            ->get();

        return response()->json($hotels);
    }

    public function searchName(Request $request)
    {
        $keyword = $request->query('name');
        $hotels = Hotel::where('name', 'LIKE', "%$keyword%")
            ->get();

        return response()->json($hotels);
    }






}
