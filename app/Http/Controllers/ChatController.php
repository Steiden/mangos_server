<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatResource;
use App\Models\Chat;
use Exception;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Чаты',
                'data' => ChatResource::collection(Chat::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения чатов',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $chat = Chat::create($request->all());
            return response()->json([
               'message' => 'Чат создан',
                'data' => new ChatResource($chat),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания чата',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $chat = Chat::find($id);
            if (!$chat) {
                return response()->json([
                   'message' => 'Чат не найден',
                   'success' => false
                ], 404);
            }
            return response()->json([
               'message' => 'Чат',
                'data' => new ChatResource($chat),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения чата',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $chat = Chat::find($id);
            if (!$chat) {
                return response()->json([
                   'message' => 'Чат не найден',
                   'success' => false
                ], 404);
            }
            $chat->update($request->all());
            return response()->json([
               'message' => 'Чат изменен',
                'data' => new ChatResource($chat),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения чата',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $chat = Chat::find($id);
            if (!$chat) {
                return response()->json([
                   'message' => 'Чат не найден',
                   'success' => false
                ], 404);
            }
            $chat->delete();
            return response()->json([
               'message' => 'Чат удален',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления чата',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
