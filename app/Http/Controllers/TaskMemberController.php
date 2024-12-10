<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskMemberResource;
use App\Models\TaskMember;
use Exception;
use Illuminate\Http\Request;

class TaskMemberController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Исполнители задач',
                'data' => TaskMemberResource::collection(TaskMember::all()),
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
            $TaskMember = TaskMember::create($request->all());
            return response()->json([
                'message' => 'Исполнитель задач создан',
                'data' => new TaskMemberResource($TaskMember),
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
            $TaskMember = TaskMember::find($id);
            if (!$TaskMember) {
                return response()->json([
                    'message' => 'Исполнитель задач не найден',
                    'success' => false
                ], 404);
            }
            $TaskMember->update($request->all());
            return response()->json([
                'message' => 'Исполнитель задач изменен',
                'data' => new TaskMemberResource($TaskMember),
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
            $TaskMember = TaskMember::find($id);
            if (!$TaskMember) {
                return response()->json([
                    'message' => 'Исполнитель задач не найден',
                    'success' => false
                ], 404);
            }
            $TaskMember->delete();
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
            $TaskMember = TaskMember::find($id);
            if (!$TaskMember) {
                return response()->json([
                    'message' => 'Исполнитель задач не найден',
                    'success' => false
                ], 404);
            }
            return response()->json([
                'message' => 'Исполнитель задач получен',
                'data' => new TaskMemberResource($TaskMember),
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
