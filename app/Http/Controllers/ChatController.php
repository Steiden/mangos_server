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
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
