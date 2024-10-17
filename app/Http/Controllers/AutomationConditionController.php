<?php

namespace App\Http\Controllers;

use App\Http\Resources\AutomationConditionResource;
use App\Models\AutomationCondition;
use Exception;
use Illuminate\Http\Request;

class AutomationConditionController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Условия автоматизации',
                'data' => AutomationConditionResource::collection(AutomationCondition::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения условий автоматизации',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $condition = AutomationCondition::create($request->all());
            return response()->json([
               'message' => 'Условие автоматизации создано',
                'data' => new AutomationConditionResource($condition),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания условия автоматизации',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $condition = AutomationCondition::find($id);
            if (!$condition) {
                return response()->json([
                   'message' => 'Условие автоматизации не найдено',
                   'success' => false
                ], 404);
            }
            return response()->json([
               'message' => 'Условие автоматизации',
                'data' => new AutomationConditionResource($condition),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения условия автоматизации',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $condition = AutomationCondition::find($id);
            if (!$condition) {
                return response()->json([
                   'message' => 'Условие автоматизации не найдено',
                   'success' => false
                ], 404);
            }
            $condition->update($request->all());
            return response()->json([
               'message' => 'Условие автоматизации изменено',
                'data' => new AutomationConditionResource($condition),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения условия автоматизации',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $condition = AutomationCondition::find($id);
            if (!$condition) {
                return response()->json([
                   'message' => 'Условие автоматизации не найдено',
                   'success' => false
                ], 404);
            }
            $condition->delete();
            return response()->json([
               'message' => 'Условие автоматизации удалено',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления условия автоматизации',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
