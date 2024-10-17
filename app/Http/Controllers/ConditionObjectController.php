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
    
    public function show($id) {
        try {
            $conditionObject = ConditionObject::find($id);
            if (!$conditionObject) {
                return response()->json([
                   'message' => 'Объект условий не найден',
                   'success' => false
                ], 404);
            }
            return response()->json([
               'message' => 'Объект условий',
                'data' => new ConditionObjectResource($conditionObject),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения объекта условий',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $conditionObject = ConditionObject::create($request->all());
            return response()->json([
               'message' => 'Объект условий создан',
                'data' => new ConditionObjectResource($conditionObject),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания объекта условий',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $conditionObject = ConditionObject::find($id);
            if (!$conditionObject) {
                return response()->json([
                   'message' => 'Объект условий не найден',
                   'success' => false
                ], 404);
            }
            $conditionObject->update($request->all());
            return response()->json([
               'message' => 'Объект условий изменен',
                'data' => new ConditionObjectResource($conditionObject),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения объекта условий',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $conditionObject = ConditionObject::find($id);
            if (!$conditionObject) {
                return response()->json([
                   'message' => 'Объект условий не найден',
                   'success' => false
                ], 404);
            }
            $conditionObject->delete();
            return response()->json([
               'message' => 'Объект условий удален',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления объекта условий',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
