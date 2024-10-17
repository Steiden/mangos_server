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

    public function store(Request $request) {
        try {
            $priority = TaskPriority::create($request->all());
            return response()->json([
               'message' => 'Новый приоритет создан',
                'data' => new TaskPriorityResource($priority),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания приоритета задач',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $priority = TaskPriority::find($id);
            if (!$priority) {
                return response()->json([
                   'message' => 'Приоритет с таким ID не найден',
                   'success' => false
                ], 404);
            }
            $priority->update($request->all());
            return response()->json([
               'message' => 'Приоритет задач успешно изменен',
                'data' => new TaskPriorityResource($priority),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения приоритета задач',
                'error' => $e->getMessage()
            ], 500);
        }
    } 

    public function destroy($id) {
        try {
            $priority = TaskPriority::find($id);
            if (!$priority) {
                return response()->json([
                   'message' => 'Приоритет с таким ID не найден',
                   'success' => false
                ], 404);
            }
            $priority->delete();
            return response()->json([
               'message' => 'Приоритет задач успешно удален',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления приоритета задач',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $priority = TaskPriority::find($id);
            if (!$priority) {
                return response()->json([
                   'message' => 'Приоритет с таким ID не найден',
                   'success' => false
                ], 404);
            }
            return response()->json([
               'message' => 'Приоритет задач получен',
                'data' => new TaskPriorityResource($priority),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения приоритета задач',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
