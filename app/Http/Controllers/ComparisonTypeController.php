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
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $comparisonType = ComparisonType::create($request->all());
            return response()->json([
                'message' => 'Тип сравнения успешно создан',
                'data' => new ComparisonTypeResource($comparisonType),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания нового типа сравнения',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $comparisonType = ComparisonType::find($id);
            $comparisonType->update($request->all());
            return response()->json([
                'message' => 'Тип сравнения успешно изменен',
                'data' => new ComparisonTypeResource($comparisonType),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения типа сравнения',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            ComparisonType::destroy($id);
            return response()->json([
                'message' => 'Тип сравнения успешно удален',
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления типа сравнения',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $comparisonType = ComparisonType::find($id);
            return response()->json([
                'message' => 'Тип сравнения',
                'data' => new ComparisonTypeResource($comparisonType),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения информации о типе сравнения',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
