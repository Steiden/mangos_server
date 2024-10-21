<?php

namespace App\Http\Controllers;

use App\Http\Resources\AutomationActionResource;
use App\Models\AutomationAction;
use Exception;
use Illuminate\Http\Request;

class AutomationActionController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Действия автоматизации',
                'data' => AutomationActionResource::collection(AutomationAction::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения действий автоматизации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $automationAction = AutomationAction::find($id);

            if (!$automationAction) {
                return response()->json([
                    'message' => 'Действие автоматизации не найдено',
                    'success' => false
                ], 404);
            }

            return response()->json([
                'message' => 'Детали действия автоматизации',
                'data' => new AutomationActionResource($automationAction),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения деталей действия автоматизации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $automationAction = AutomationAction::create($request->all());

            return response()->json([
                'message' => 'Действие автоматизации создано',
                'data' => new AutomationActionResource($automationAction),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания действия автоматизации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $automationAction = AutomationAction::find($id);

            if (!$automationAction) {
                return response()->json([
                    'message' => 'Действие автоматизации не найдено',
                    'success' => false
                ], 404);
            }

            $automationAction->update($request->all());

            return response()->json([
                'message' => 'Действие автоматизации изменено',
                'data' => new AutomationActionResource($automationAction),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения действия автоматизации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $automationAction = AutomationAction::find($id);

            if (!$automationAction) {
                return response()->json([
                    'message' => 'Действие автоматизации не найдено',
                    'success' => false
                ], 404);
            }

            $automationAction->delete();

            return response()->json([
                'message' => 'Действие автоматизации удалено',
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления действия автоматизации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
