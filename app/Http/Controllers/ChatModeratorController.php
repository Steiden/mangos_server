<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatModeratorResource;
use App\Models\ChatModerator;
use Exception;
use Illuminate\Http\Request;

class ChatModeratorController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Модераторы чатов',
                'data' => ChatModeratorResource::collection(ChatModerator::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения модераторов чатов',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $moderator = ChatModerator::find($id);

            if (!$moderator) {
                return response()->json([
                    'message' => 'Модератор не найден',
                    'success' => false
                ], 404);
            }

            return response()->json([
                'message' => 'Модератор чата',
                'data' => new ChatModeratorResource($moderator),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения модератора чата',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $moderator = ChatModerator::create($request->all());

            return response()->json([
                'message' => 'Модератор чата создан',
                'data' => new ChatModeratorResource($moderator),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания модератора чата',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $moderator = ChatModerator::find($id);

            if (!$moderator) {
                return response()->json([
                    'message' => 'Модератор не найден',
                    'success' => false
                ], 404);
            }

            $moderator->update($request->all());

            return response()->json([
                'message' => 'Модератор чата изменен',
                'data' => new ChatModeratorResource($moderator),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения модератора чата',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $moderator = ChatModerator::find($id);

            if (!$moderator) {
                return response()->json([
                    'message' => 'Модератор не найден',
                    'success' => false
                ], 404);
            }

            $moderator->delete();

            return response()->json([
                'message' => 'Модератор чата удален',
                'success' => true
            ], 204);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления модератора чата',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
