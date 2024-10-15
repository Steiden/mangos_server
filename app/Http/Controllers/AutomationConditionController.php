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
}
