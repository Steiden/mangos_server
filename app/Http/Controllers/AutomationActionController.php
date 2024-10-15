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
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
