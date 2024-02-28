<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kursi; // Make sure to import the Kursi model

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming data
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Create a new course using the validated data
        $kursi = $this->create($request);

        return response()->json(['message' => 'Course added successfully', 'data' => $kursi], 201);
    }

    private function validateRequest(Request $request)
    {
        // Define validation rules
        $rules = [
            'kurssTitle' => 'required|string|max:255',
            'additionalText' => 'nullable|string',
            'bannerAdress' => 'required|string|max:255',
            'cilvekuCount' => 'required|integer|min:0',
        ];

        // Validate incoming data using the defined rules
        return Validator::make($request->all(), $rules);
    }

    private function create(Request $request)
    {
        // Create a new course using the validated data
        return Kursi::create([
            'kurssTitle' => $request->input('kurssTitle'),
            'additionalText' => $request->input('additionalText'),
            'bannerAdress' => $request->input('bannerAdress'),
            'cilvekuCount' => $request->input('cilvekuCount'),
        ]);
    }
}
