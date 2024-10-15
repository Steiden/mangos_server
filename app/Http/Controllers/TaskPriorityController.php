<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskPriorityResource;
use App\Models\TaskPriority;
use Exception;
use Illuminate\Http\Request;

class TaskPriorityController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Приоритеты задач',
                'data' => TaskPriorityResource::collection(TaskPriority::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения приоритетов задач',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
