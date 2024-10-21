<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Категории',
                'data' => CategoryResource::collection(Category::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения категорий',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $validatedData = $request->validate([
                'name' =>'required|string|max:255',
            ]);

            $category = Category::create($validatedData);

            return response()->json([
               'message' => 'Категория создана',
                'data' => new CategoryResource($category),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания категории',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                   'message' => 'Категория не найдена',
                   'success' => false
                ], 404);
            }

            return response()->json([
               'message' => 'Категория',
                'data' => new CategoryResource($category),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения категории',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                   'message' => 'Категория не найдена',
                   'success' => false
                ], 404);
            }

            $validatedData = $request->validate([
                'name' =>'required|string|max:255',
            ]);

            $category->update($validatedData);

            return response()->json([
               'message' => 'Категория изменена',
                'data' => new CategoryResource($category),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения категории',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                   'message' => 'Категория не найдена',
                   'success' => false
                ], 404);
            }

            $category->delete();

            return response()->json([
               'message' => 'Категория удалена',
               'success' => true
            ], 204);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления категории',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
