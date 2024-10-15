<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskTagResource;
use App\Models\TaskTag;
use Exception;
use Illuminate\Http\Request;

class TaskTagController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Теги задач',
                'data' => TaskTagResource::collection(TaskTag::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения тегов задач',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
