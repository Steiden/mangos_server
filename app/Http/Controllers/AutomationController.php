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

    public function store(Request $request) {
        try {
            $automation = Automation::create($request->all());

            return response()->json([
               'message' => 'Автоматизация создана',
                'data' => new AutomationResource($automation),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания автоматизации',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $automation = Automation::find($id);

            if (!$automation) {
                return response()->json([
                   'message' => 'Автоматизация не найдена',
                   'success' => false
                ], 404);
            }

            return response()->json([
               'message' => 'Автоматизация',
                'data' => new AutomationResource($automation),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения автоматизации',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $automation = Automation::find($id);

            if (!$automation) {
                return response()->json([
                   'message' => 'Автоматизация не найдена',
                   'success' => false
                ], 404);
            }

            $automation->update($request->all());

            return response()->json([
               'message' => 'Автоматизация изменена',
                'data' => new AutomationResource($automation),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения автоматизации',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $automation = Automation::find($id);

            if (!$automation) {
                return response()->json([
                   'message' => 'Автоматизация не найдена',
                   'success' => false
                ], 404);
            }

            $automation->delete();

            return response()->json([
               'message' => 'Автоматизация удалена',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления автоматизации',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
