<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Задачи',
                'data' => TaskResource::collection(Task::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения задач',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
