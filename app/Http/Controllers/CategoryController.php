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
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
