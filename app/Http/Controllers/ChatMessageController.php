<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChatMessageResource;
use App\Models\ChatMessage;
use Exception;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Сообщения чатов',
                'data' => ChatMessageResource::collection(ChatMessage::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения сообщений чатов',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $chatMessage = ChatMessage::find($id);
            if (!$chatMessage) {
                return response()->json([
                   'message' => 'Сообщение не найдено',
                   'success' => false
                ], 404);
            }
            return response()->json([
               'message' => 'Сообщение чата',
                'data' => new ChatMessageResource($chatMessage),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения сообщения чата',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $chatMessage = ChatMessage::create($request->all());
            return response()->json([
               'message' => 'Сообщение чата создано',
                'data' => new ChatMessageResource($chatMessage),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания сообщения чата',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $chatMessage = ChatMessage::find($id);
            if (!$chatMessage) {
                return response()->json([
                   'message' => 'Сообщение не найдено',
                   'success' => false
                ], 404);
            }
            $chatMessage->update($request->all());
            return response()->json([
               'message' => 'Сообщение чата изменено',
                'data' => new ChatMessageResource($chatMessage),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения сообщения чата',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $chatMessage = ChatMessage::find($id);
            if (!$chatMessage) {
                return response()->json([
                   'message' => 'Сообщение не найдено',
                   'success' => false
                ], 404);
            }
            $chatMessage->delete();
            return response()->json([
               'message' => 'Сообщение чата удалено',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления сообщения чата',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}