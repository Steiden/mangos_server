<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageTypeResource;
use App\Models\MessageType;
use Exception;
use Illuminate\Http\Request;

class MessageTypeController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Типы сообщений',
                'data' => MessageTypeResource::collection(MessageType::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения типов сообщений',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
