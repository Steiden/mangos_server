<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Роли',
                'data' => RoleResource::collection(Role::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения ролей',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'name' =>'required|string|max:255',
            ]);

            $role = Role::create($validatedData);

            return response()->json([
               'message' => 'Роль создана',
                'data' => new RoleResource($role),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания роли',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $role = Role::find($id);

            if (!$role) {
                return response()->json([
                   'message' => 'Роль не найдена',
                   'success' => false
                ], 404);
            }

            $validatedData = $request->validate([
                'name' =>'required|string|max:255',
            ]);

            $role->update($validatedData);

            return response()->json([
               'message' => 'Роль изменена',
                'data' => new RoleResource($role),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения роли',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $role = Role::find($id);

            if (!$role) {
                return response()->json([
                   'message' => 'Роль не найдена',
                   'success' => false
                ], 404);
            }

            $role->delete();

            return response()->json([
               'message' => 'Роль удалена',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления роли',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $role = Role::find($id);

            if (!$role) {
                return response()->json([
                   'message' => 'Роль не найдена',
                   'success' => false
                ], 404);
            }

            return response()->json([
               'message' => 'Роль',
                'data' => new RoleResource($role),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения роли',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
