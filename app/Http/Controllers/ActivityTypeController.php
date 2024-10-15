<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityTypeResource;
use App\Models\ActivityType;
use Exception;
use Illuminate\Http\Request;

class ActivityTypeController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Виды деятельности',
                'data' => ActivityTypeResource::collection(ActivityType::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения видов деятельности',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
