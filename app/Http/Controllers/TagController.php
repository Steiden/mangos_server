<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Теги',
                'data' => TagResource::collection(Tag::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения тегов',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
