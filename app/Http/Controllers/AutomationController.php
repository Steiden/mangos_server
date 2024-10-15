<?php

namespace App\Http\Controllers;

use App\Http\Resources\AutomationResource;
use App\Models\Automation;
use Exception;
use Illuminate\Http\Request;

class AutomationController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Автоматизации',
                'data' => AutomationResource::collection(Automation::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения автоматизаций',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
