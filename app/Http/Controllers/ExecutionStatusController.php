<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExecutionStatusResource;
use App\Models\ExecutionStatus;
use Exception;
use Illuminate\Http\Request;

class ExecutionStatusController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Статусы выполнения',
                'data' => ExecutionStatusResource::collection(ExecutionStatus::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Статусов выполнения',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
