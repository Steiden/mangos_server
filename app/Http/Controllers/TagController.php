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
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:tags,name'
            ]);

            $tag = Tag::create($validatedData);

            return response()->json([
                'message' => 'Тег создан',
                'data' => new TagResource($tag),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания тега',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $tag = Tag::find($id);

            if (!$tag) {
                return response()->json([
                    'message' => 'Тег не найден',
                    'success' => false
                ], 404);
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:tags,name,' . $id
            ]);

            $tag->update($validatedData);

            return response()->json([
                'message' => 'Тег изменен',
                'data' => new TagResource($tag),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения тега',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $tag = Tag::find($id);

            if (!$tag) {
                return response()->json([
                    'message' => 'Тег не найден',
                    'success' => false
                ], 404);
            }

            $tag->delete();

            return response()->json([
                'message' => 'Тег удален',
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления тега',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $tag = Tag::find($id);

            if (!$tag) {
                return response()->json([
                    'message' => 'Тег не найден',
                    'success' => false
                ], 404);
            }

            return response()->json([
                'message' => 'Тег',
                'data' => new TagResource($tag),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения тега',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
