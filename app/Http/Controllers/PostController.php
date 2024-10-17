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

    public function store(Request $request) {
        try {
            $post = Post::create($request->all());
            return response()->json([
               'message' => 'Должность успешно создана',
                'data' => new PostResource($post),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания должности',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json([
                   'message' => 'Должность не найдена',
                   'success' => false
                ], 404);
            }
            return response()->json([
               'message' => 'Должность',
                'data' => new PostResource($post),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения должности',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json([
                   'message' => 'Должность не найдена',
                   'success' => false
                ], 404);
            }
            $post->update($request->all());
            return response()->json([
               'message' => 'Должность успешно изменена',
                'data' => new PostResource($post),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения должности',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json([
                   'message' => 'Должность не найдена',
                   'success' => false
                ], 404);
            }
            $post->delete();
            return response()->json([
               'message' => 'Должность успешно удалена',
               'success' => true
            ], 204);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления должности',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
