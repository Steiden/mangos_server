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
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
