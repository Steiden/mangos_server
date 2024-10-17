<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventMemberResource;
use App\Models\EventMember;
use Exception;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Участники событий',
                'data' => EventMemberResource::collection(EventMember::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения участников событий',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $eventMember = EventMember::create($request->all());
            return response()->json([
               'message' => 'Участник события создан',
                'data' => new EventMemberResource($eventMember),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания участника события',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $eventMember = EventMember::find($id);
            if (!$eventMember) {
                return response()->json([
                   'message' => 'Участник события не найден',
                   'success' => false
                ], 404);
            }
            $eventMember->update($request->all());
            return response()->json([
               'message' => 'Участник события изменен',
                'data' => new EventMemberResource($eventMember),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения участника события',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $eventMember = EventMember::find($id);
            if (!$eventMember) {
                return response()->json([
                   'message' => 'Участник события не найден',
                   'success' => false
                ], 404);
            }
            $eventMember->delete();
            return response()->json([
               'message' => 'Участник события удален',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления участника события',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $eventMember = EventMember::find($id);
            if (!$eventMember) {
                return response()->json([
                   'message' => 'Участник события не найден',
                   'success' => false
                ], 404);
            }
            return response()->json([
               'message' => 'Информация о участнике события',
                'data' => new EventMemberResource($eventMember),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения информации о участнике события',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
