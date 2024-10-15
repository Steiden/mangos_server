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
}
