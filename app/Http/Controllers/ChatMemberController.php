<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatMemberResource;
use App\Models\ChatMember;
use Exception;
use Illuminate\Http\Request;

class ChatMemberController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Участники чатов',
                'data' => ChatMemberResource::collection(ChatMember::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения участников чатов',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $chatMember = ChatMember::find($id);

            if (!$chatMember) {
                return response()->json([
                   'message' => 'Участник не найден',
                   'success' => false
                ], 404);
            }

            return response()->json([
               'message' => 'Информация об участнике чата',
                'data' => new ChatMemberResource($chatMember),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения информации об участнике чата',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'chat_id' =>'required|exists:chats,id',
                'user_id' =>'required|exists:users,id',
            ]);

            $chatMember = ChatMember::create($validatedData);

            return response()->json([
               'message' => 'Участник добавлен в чат',
                'data' => new ChatMemberResource($chatMember),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка добавления участника в чат',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $chatMember = ChatMember::find($id);

            if (!$chatMember) {
                return response()->json([
                   'message' => 'Участник не найден',
                   'success' => false
                ], 404);
            }

            $chatMember->delete();

            return response()->json([
               'message' => 'Участник удален из чата',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления участника из чата',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update($id, Request $request) {
        try {
            $chatMember = ChatMember::find($id);

            if (!$chatMember) {
                return response()->json([
                   'message' => 'Участник не найден',
                   'success' => false
                ], 404);
            }

            $validatedData = $request->validate([
                'status' => 'nullable|in:active,inactive',
            ]);

            $chatMember->update($validatedData);

            return response()->json([
               'message' => 'Статус участника изменен',
                'data' => new ChatMemberResource($chatMember),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения статуса участника',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
