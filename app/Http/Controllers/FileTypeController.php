<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileTypeResource;
use App\Models\FileType;
use Exception;
use Illuminate\Http\Request;

class FileTypeController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Типы файлов',
                'data' => FileTypeResource::collection(FileType::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения типов файлов',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $fileType = FileType::create($request->all());
            return response()->json([
                'message' => 'Тип файла создан',
                'data' => new FileTypeResource($fileType),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания нового типа файла',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $fileType = FileType::find($id);

            if (!$fileType) {
                return response()->json([
                    'message' => 'Тип файла не найден',
                    'success' => false
                ], 404);
            }

            $fileType->update($request->all());
            return response()->json([
                'message' => 'Тип файла изменен',
                'data' => new FileTypeResource($fileType),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения типа файла',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            FileType::destroy($id);
            return response()->json([
                'message' => 'Тип файла удален',
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления типа файла',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $fileType = FileType::find($id);

            if (!$fileType) {
                return response()->json([
                    'message' => 'Тип файла не найден',
                    'success' => false
                ], 404);
            }

            return response()->json([
                'message' => 'Информация о типе файла',
                'data' => new FileTypeResource($fileType),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения информации о типе файла',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
