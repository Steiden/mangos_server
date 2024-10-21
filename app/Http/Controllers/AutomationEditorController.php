<?php

namespace App\Http\Controllers;

use App\Http\Resources\AutomationEditorResource;
use App\Models\AutomationEditor;
use Exception;
use Illuminate\Http\Request;

class AutomationEditorController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Редакторы автоматизаций',
                'data' => AutomationEditorResource::collection(AutomationEditor::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения редакторов автоматизаций',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $automationEditor = AutomationEditor::find($id);
            if (!$automationEditor) {
                return response()->json([
                   'message' => 'Редактор автоматизации не найден',
                   'success' => false
                ], 404);
            }
            return response()->json([
               'message' => 'Редактор автоматизации',
                'data' => new AutomationEditorResource($automationEditor),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения редактора автоматизации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $automationEditor = AutomationEditor::create($request->all());
            return response()->json([
               'message' => 'Редактор автоматизации создан',
                'data' => new AutomationEditorResource($automationEditor),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания редактора автоматизации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $automationEditor = AutomationEditor::find($id);
            if (!$automationEditor) {
                return response()->json([
                   'message' => 'Редактор автоматизации не найден',
                   'success' => false
                ], 404);
            }
            $automationEditor->update($request->all());
            return response()->json([
               'message' => 'Редактор автоматизации изменен',
                'data' => new AutomationEditorResource($automationEditor),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения редактора автоматизации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $automationEditor = AutomationEditor::find($id);
            if (!$automationEditor) {
                return response()->json([
                   'message' => 'Редактор автоматизации не найден',
                   'success' => false
                ], 404);
            }
            $automationEditor->delete();
            return response()->json([
               'message' => 'Редактор автоматизации удален',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления редактора автоматизации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
