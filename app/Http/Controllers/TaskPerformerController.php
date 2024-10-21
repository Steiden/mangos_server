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
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $taskPerformer = TaskPerformer::create($request->all());
            return response()->json([
                'message' => 'Исполнитель задач создан',
                'data' => new TaskPerformerResource($taskPerformer),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания исполнителя задач',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $taskPerformer = TaskPerformer::find($id);
            if (!$taskPerformer) {
                return response()->json([
                    'message' => 'Исполнитель задач не найден',
                    'success' => false
                ], 404);
            }
            $taskPerformer->update($request->all());
            return response()->json([
                'message' => 'Исполнитель задач изменен',
                'data' => new TaskPerformerResource($taskPerformer),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения исполнителя задач',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $taskPerformer = TaskPerformer::find($id);
            if (!$taskPerformer) {
                return response()->json([
                    'message' => 'Исполнитель задач не найден',
                    'success' => false
                ], 404);
            }
            $taskPerformer->delete();
            return response()->json([
                'message' => 'Исполнитель задач удален',
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления исполнителя задач',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $taskPerformer = TaskPerformer::find($id);
            if (!$taskPerformer) {
                return response()->json([
                    'message' => 'Исполнитель задач не найден',
                    'success' => false
                ], 404);
            }
            return response()->json([
                'message' => 'Исполнитель задач получен',
                'data' => new TaskPerformerResource($taskPerformer),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения исполнителя задач',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
