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
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
