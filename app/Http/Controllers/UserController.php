<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Список пользователей',
                'data' => UserResource::collection(User::all()),
                'success' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка получения пользователей: ' . $e->getMessage());
            return response()->json([
                'message' => 'Ошибка получения пользователей',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
}
