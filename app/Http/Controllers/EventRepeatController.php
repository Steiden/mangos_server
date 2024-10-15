<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventRepeatResource;
use App\Models\EventRepeat;
use Exception;
use Illuminate\Http\Request;

class EventRepeatController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Повторения события',
                'data' => EventRepeatResource::collection(EventRepeat::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Повторений событий',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
