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
}
