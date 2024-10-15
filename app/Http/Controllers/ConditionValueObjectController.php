<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConditionValueObjectResource;
use App\Models\ConditionValueObject;
use Exception;
use Illuminate\Http\Request;

class ConditionValueObjectController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Объекты значений условий',
                'data' => ConditionValueObjectResource::collection(ConditionValueObject::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения объектов значений условий',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
