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
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $task = Task::create($request->all());
            return response()->json([
                'message' => 'Задача создана',
                'data' => new TaskResource($task),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания задачи',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $task = Task::find($id);
            if ($task) {
                return response()->json([
                    'message' => 'Задача',
                    'data' => new TaskResource($task),
                    'success' => true
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Задача не найдена',
                    'success' => false
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения задачи',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $task = Task::find($id);
            if ($task) {
                $task->update($request->all());
                return response()->json([
                    'message' => 'Задача изменена',
                    'data' => new TaskResource($task),
                    'success' => true
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Задача не найдена',
                    'success' => false
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения задачи',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $task = Task::find($id);
            if ($task) {
                $task->delete();
                return response()->json([
                    'message' => 'Задача удалена',
                    'success' => true
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Задача не найдена',
                    'success' => false
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления задачи',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
