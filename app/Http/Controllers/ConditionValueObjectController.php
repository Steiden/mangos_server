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

    public function show($id) {
        try {
            $conditionValueObject = ConditionValueObject::find($id);
            if (!$conditionValueObject) {
                return response()->json([
                   'message' => 'Объект значений условий не найден',
                   'success' => false
                ], 404);
            }
            return response()->json([
               'message' => 'Объект значений условий',
                'data' => new ConditionValueObjectResource($conditionValueObject),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения объекта значений условий',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $conditionValueObject = ConditionValueObject::create($request->all());
            return response()->json([
               'message' => 'Объект значений условий создан',
                'data' => new ConditionValueObjectResource($conditionValueObject),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания объекта значений условий',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $conditionValueObject = ConditionValueObject::find($id);
            if (!$conditionValueObject) {
                return response()->json([
                   'message' => 'Объект значений условий не найден',
                   'success' => false
                ], 404);
            }
            $conditionValueObject->update($request->all());
            return response()->json([
               'message' => 'Объект значений условий изменен',
                'data' => new ConditionValueObjectResource($conditionValueObject),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения объекта значений условий',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $conditionValueObject = ConditionValueObject::find($id);
            if (!$conditionValueObject) {
                return response()->json([
                   'message' => 'Объект значений условий не найден',
                   'success' => false
                ], 404);
            }
            $conditionValueObject->delete();
            return response()->json([
               'message' => 'Объект значений условий удален',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления объекта значений условий',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
