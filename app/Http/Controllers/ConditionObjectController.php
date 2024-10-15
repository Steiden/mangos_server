<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConditionObjectResource;
use App\Models\ConditionObject;
use Exception;
use Illuminate\Http\Request;

class ConditionObjectController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Объекты условий',
                'data' => ConditionObjectResource::collection(ConditionObject::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения объектов условий',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
