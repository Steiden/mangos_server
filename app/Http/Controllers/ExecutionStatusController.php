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
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $executionStatus = ExecutionStatus::create($request->all());
            return response()->json([
                'message' => 'Статус выполнения создан',
                'data' => new ExecutionStatusResource($executionStatus),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Статус выполнения создать',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $executionStatus = ExecutionStatus::find($id);
            if (!$executionStatus) {
                return response()->json([
                    'message' => 'Статус выполнения не найден',
                    'success' => false
                ], 404);
            }
            return response()->json([
                'message' => 'Статус выполнения',
                'data' => new ExecutionStatusResource($executionStatus),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Статус выполнения получить',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $executionStatus = ExecutionStatus::find($id);
            if (!$executionStatus) {
                return response()->json([
                    'message' => 'Статус выполнения не найден',
                    'success' => false
                ], 404);
            }
            $executionStatus->update($request->all());
            return response()->json([
                'message' => 'Статус выполнения изменен',
                'data' => new ExecutionStatusResource($executionStatus),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Статус выполнения изменить',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $executionStatus = ExecutionStatus::find($id);
            if (!$executionStatus) {
                return response()->json([
                    'message' => 'Статус выполнения не найден',
                    'success' => false
                ], 404);
            }
            $executionStatus->delete();
            return response()->json([
                'message' => 'Статус выполнения удален',
                'success' => true
            ], 204);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Статус выполнения удалить',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
