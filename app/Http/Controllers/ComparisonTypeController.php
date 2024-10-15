<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComparisonTypeResource;
use App\Models\ComparisonType;
use Exception;
use Illuminate\Http\Request;

class ComparisonTypeController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Типы сравнения',
                'data' => ComparisonTypeResource::collection(ComparisonType::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения типов сравнения',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
