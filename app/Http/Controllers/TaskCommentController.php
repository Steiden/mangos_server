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
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $comment = TaskComment::create($request->all());
            return response()->json([
                'message' => 'Комментарий добавлен',
                'data' => new TaskCommentResource($comment),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания комментария',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $comment = TaskComment::find($id);
            if (!$comment) {
                return response()->json([
                    'message' => 'Комментарий не найден',
                    'success' => false
                ], 404);
            }
            return response()->json([
                'message' => 'Комментарий',
                'data' => new TaskCommentResource($comment),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения комментария',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $comment = TaskComment::find($id);
            if (!$comment) {
                return response()->json([
                    'message' => 'Комментарий не найден',
                    'success' => false
                ], 404);
            }
            $comment->update($request->all());
            return response()->json([
                'message' => 'Комментарий изменен',
                'data' => new TaskCommentResource($comment),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения комментария',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $comment = TaskComment::find($id);
            if (!$comment) {
                return response()->json([
                    'message' => 'Комментарий не найден',
                    'success' => false
                ], 404);
            }
            $comment->delete();
            return response()->json([
                'message' => 'Комментарий удален',
                'success' => true
            ], 204);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления комментария',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
