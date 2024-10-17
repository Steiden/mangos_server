<?php

namespace App\Http\Controllers;

use App\Http\Resources\DivisionResource;
use App\Models\Division;
use Exception;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Подразделения',
                'data' => DivisionResource::collection(Division::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения подразделений',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $division = Division::find($id);

            if (!$division) {
                return response()->json([
                   'message' => 'Подразделение не найдено',
                   'success' => false
                ], 404);
            }

            return response()->json([
               'message' => 'Подразделение',
                'data' => new DivisionResource($division),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения подразделения',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $division = Division::create($request->all());

            return response()->json([
               'message' => 'Подразделение создано',
                'data' => new DivisionResource($division),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания подразделения',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $division = Division::find($id);

            if (!$division) {
                return response()->json([
                   'message' => 'Подразделение не найдено',
                   'success' => false
                ], 404);
            }

            $division->update($request->all());

            return response()->json([
               'message' => 'Подразделение изменено',
                'data' => new DivisionResource($division),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения подразделения',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $division = Division::find($id);

            if (!$division) {
                return response()->json([
                   'message' => 'Подразделение не найдено',
                   'success' => false
                ], 404);
            }

            $division->delete();

            return response()->json([
               'message' => 'Подразделение удалено',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления подразделения',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
