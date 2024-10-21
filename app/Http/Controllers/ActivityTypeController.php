<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityTypeResource;
use App\Models\ActivityType;
use Exception;
use Illuminate\Http\Request;

class ActivityTypeController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Виды деятельности',
                'data' => ActivityTypeResource::collection(ActivityType::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения видов деятельности',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $activityType = ActivityType::create($request->all());
            return response()->json([
                'message' => 'Вид деятельности создан',
                'data' => new ActivityTypeResource($activityType),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания вида деятельности',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $activityType = ActivityType::find($id);
            if (!$activityType) {
                return response()->json([
                    'message' => 'Вид деятельности не найден',
                    'success' => false
                ], 404);
            }
            return response()->json([
                'message' => 'Информация о виде деятельности',
                'data' => new ActivityTypeResource($activityType),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения информации о виде деятельности',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $activityType = ActivityType::find($id);
            if (!$activityType) {
                return response()->json([
                    'message' => 'Вид деятельности не найден',
                    'success' => false
                ], 404);
            }
            $activityType->update($request->all());
            return response()->json([
                'message' => 'Информация о виде деятельности изменена',
                'data' => new ActivityTypeResource($activityType),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения информации о виде деятельности',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $activityType = ActivityType::find($id);
            if (!$activityType) {
                return response()->json([
                    'message' => 'Вид деятельности не найден',
                    'success' => false
                ], 404);
            }
            $activityType->delete();
            return response()->json([
                'message' => 'Вид деятельности удален',
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления вида деятельности',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
}
