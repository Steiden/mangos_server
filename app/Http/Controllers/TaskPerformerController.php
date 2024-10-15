<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskPerformerResource;
use App\Models\TaskPerformer;
use Exception;
use Illuminate\Http\Request;

class TaskPerformerController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Исполнители задач',
                'data' => TaskPerformerResource::collection(TaskPerformer::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения исполнителей задач',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
