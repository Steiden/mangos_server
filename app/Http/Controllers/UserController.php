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

    public function show($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'message' => 'Пользователь не найден',
                    'error' => 'User not found',
                    'success' => false
                ], 404);
            }
            return response()->json([
                'message' => 'Пользователь',
                'data' => new UserResource($user),
                'success' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка получения пользователя: ' . $e->getMessage());
            return response()->json([
                'message' => 'Ошибка получения пользователя',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'login' => 'required|string|unique:users,login',
                'password' => 'required|string',
                'avatar' => '',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'patronymic' => 'string',
                'phone' => 'string',
                'email' => 'required|string|unique:users,email',
                'is_subordinate' => 'boolean',
                'organization_id' => 'integer',
            ]);

            $validatedData['password'] = bcrypt($request->get('password'));

            $user = User::create($validatedData);

            return response()->json([
                'message' => 'Пользователь создан',
                'data' => new UserResource($user),
                'success' => true
            ], 201);
        } catch (\Exception $e) {
            Log::error('Ошибка создания пользователя: ' . $e->getMessage());
            return response()->json([
                'message' => 'Ошибка создания пользователя',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'message' => 'Пользователь не найден',
                    'error' => 'User not found',
                    'success' => false
                ], 404);
            }

            $validatedData = $request->validate([]);

            $user->update($validatedData);

            return response()->json([
                'message' => 'Пользователь изменен',
                'data' => new UserResource($user),
                'success' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка изменения пользователя:', $e);
            return response()->json([
                'message' => 'Ошибка изменения пользователя',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'message' => 'Пользователь не найден',
                    'error' => 'User not found',
                    'success' => false
                ], 404);
            }

            $user->delete();

            return response()->json([
                'message' => 'Пользователь удален',
                'success' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка удаления пользователя:', $e);
            return response()->json([
                'message' => 'Ошибка удаления пользователя',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $searchQuery = $request->input('search');
            $users = User::where('login', 'LIKE', "%{$searchQuery}%")
                ->orWhere('email', 'LIKE', "%{$searchQuery}%")
                ->paginate(10);

            return response()->json([
                'message' => 'Поиск пользователей',
                'data' => UserResource::collection($users),
                'success' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Ошибка поиска пользователей:', $e);
            return response()->json([
                'message' => 'Ошибка поиска пользователей',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
}
