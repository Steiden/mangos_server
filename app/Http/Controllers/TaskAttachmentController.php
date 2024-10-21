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
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $attachment = TaskAttachment::create($request->all());
            return response()->json([
                'message' => 'Вложение успешно создано',
                'data' => new TaskAttachmentResource($attachment),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания вложения',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $attachment = TaskAttachment::find($id);
            if (!$attachment) {
                return response()->json([
                    'message' => 'Вложение не найдено',
                    'success' => false
                ], 404);
            }
            return response()->json([
                'message' => 'Вложение',
                'data' => new TaskAttachmentResource($attachment),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения вложения',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $attachment = TaskAttachment::find($id);
            if (!$attachment) {
                return response()->json([
                    'message' => 'Вложение не найдено',
                    'success' => false
                ], 404);
            }
            $attachment->update($request->all());
            return response()->json([
                'message' => 'Вложение успешно изменено',
                'data' => new TaskAttachmentResource($attachment),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения вложения',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            TaskAttachment::destroy($id);
            return response()->json([
                'message' => 'Вложение успешно удалено',
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления вложения',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
