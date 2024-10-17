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

    public function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'name' =>'required|string|max:255',
            ]);

            $taskTag = TaskTag::create($validatedData);

            return response()->json([
               'message' => 'Тег добавлен',
                'data' => new TaskTagResource($taskTag),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания тега',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $taskTag = TaskTag::find($id);

            if (!$taskTag) {
                return response()->json([
                   'message' => 'Тег не найден',
                   'success' => false
                ], 404);
            }

            $validatedData = $request->validate([]);

            $taskTag->update($validatedData);

            return response()->json([
               'message' => 'Тег изменен',
                'data' => new TaskTagResource($taskTag),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения тега',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $taskTag = TaskTag::find($id);

            if (!$taskTag) {
                return response()->json([
                   'message' => 'Тег не найден',
                   'success' => false
                ], 404);
            }

            $taskTag->delete();

            return response()->json([
               'message' => 'Тег удален',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления тега',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $taskTag = TaskTag::find($id);

            if (!$taskTag) {
                return response()->json([
                   'message' => 'Тег не найден',
                   'success' => false
                ], 404);
            }

            return response()->json([
               'message' => 'Тег получен',
                'data' => new TaskTagResource($taskTag),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения тега',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
