<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'login' => 'required|string',
                'password' => 'required|string'
            ]);

            $user = User::where(['login' => $validatedData])->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Пользователь не найден',
                ], 404);
            }

            if (!\password_verify($validatedData['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Неверный пароль',
                ], 401);
            }

            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'data' => [
                    'token' => $token
                ],
                'message' => 'Авторизация успешна'
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка авторизации: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ошибка авторизации',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $token = $request->user()->token();
            $token->revoke();

            return response()->json([
                'success' => true,
                'message' => 'Выход из системы успешен'
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка выхода из системы: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ошибка выхода из системы',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function refresh(Request $request)
    {
        try {
            $token = $request->user()->token();
            $newToken = $token->refresh();

            return response()->json([
                'success' => true,
                'data' => [
                    'token' => $newToken,
                ],
                'message' => 'Токен успешно обновлен'
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка обновления токена: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ошибка обновления токена',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function me(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => true,
                    'message' => 'Пользователь не авторизован',
                    'data' => null
                ], 200);
            }

            return response()->json([
                'success' => true,
                'data' => new UserResource($user),
                'message' => 'Информация о пользователе'
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка получения информации о пользователе: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ошибка получения информации о пользователе',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
