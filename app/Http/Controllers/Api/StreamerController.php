<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Streamer;

class StreamerController extends Controller
{
    public function index()
    {
        return response()->json(Streamer::all());
    }

    public function show(Streamer $streamer)
    {
        return response()->json($streamer);
    }
}
