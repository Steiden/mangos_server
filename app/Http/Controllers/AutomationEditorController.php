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
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
