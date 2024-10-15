<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Сообщения',
                'data' => MessageResource::collection(Message::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения сообщений',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
