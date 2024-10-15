<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Должности',
                'data' => PostResource::collection(Post::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения должностей',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
