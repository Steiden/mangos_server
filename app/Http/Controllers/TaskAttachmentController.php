<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskAttachmentResource;
use App\Models\TaskAttachment;
use Exception;
use Illuminate\Http\Request;

class TaskAttachmentController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Вложения задач',
                'data' => TaskAttachmentResource::collection(TaskAttachment::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения вложений задач',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
