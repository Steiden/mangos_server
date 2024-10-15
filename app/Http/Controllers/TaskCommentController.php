<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskCommentResource;
use App\Models\TaskComment;
use Exception;
use Illuminate\Http\Request;

class TaskCommentController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Комментарии задач',
                'data' => TaskCommentResource::collection(TaskComment::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения комментариев задач',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
