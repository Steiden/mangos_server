<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventRepeatResource;
use App\Models\EventRepeat;
use Exception;
use Illuminate\Http\Request;

class EventRepeatController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Повторения события',
                'data' => EventRepeatResource::collection(EventRepeat::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Повторений событий',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $eventRepeat = EventRepeat::create($request->all());

            return response()->json([
                'message' => 'Событие повторено',
                'data' => new EventRepeatResource($eventRepeat),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Событие повторено',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $eventRepeat = EventRepeat::find($id);
            if (!$eventRepeat) {
                return response()->json([
                    'message' => 'Повторения события не найдены',
                    'success' => false
                ], 404);
            }

            $eventRepeat->update($request->all());

            return response()->json([
                'message' => 'Изменения сохранены',
                'data' => new EventRepeatResource($eventRepeat),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Изменения сохранены',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $eventRepeat = EventRepeat::find($id);
            if (!$eventRepeat) {
                return response()->json([
                    'message' => 'Повторения события не найдены',
                    'success' => false
                ], 404);
            }

            $eventRepeat->delete();

            return response()->json([
                'message' => 'Повторения события удалены',
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Повторения события удалены',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $eventRepeat = EventRepeat::find($id);
            if (!$eventRepeat) {
                return response()->json([
                    'message' => 'Повторения события не найдены',
                    'success' => false
                ], 404);
            }

            return response()->json([
                'message' => 'Повторения события',
                'data' => new EventRepeatResource($eventRepeat),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Повторения события',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
