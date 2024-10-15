<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'События',
                'data' => EventResource::collection(Event::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения событий',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
