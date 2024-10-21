<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileResource;
use App\Models\File;
use Exception;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Файлы',
                'data' => FileResource::collection(File::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения файлов',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([]);

            $file = $request->file('file');
            $fileName = $validatedData['name'] . '.' . $file->getClientOriginalExtension();

            $file->storeAs('uploads', $fileName);

            File::create([
                'name' => $validatedData['name'],
                'path' => $fileName
            ]);

            return response()->json([
                'message' => 'Файл успешно загружен',
                'data' => new FileResource(File::where('name', $validatedData['name'])->first()),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания файла',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $file = File::find($id);

            if (!$file) {
                return response()->json([
                    'message' => 'Файл не найден',
                    'success' => false
                ], 404);
            }

            return response()->json([
                'message' => 'Файл',
                'data' => new FileResource($file),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения файла',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $validatedData = $request->validate([]);

            $file = File::find($id);

            if (!$file) {
                return response()->json([
                    'message' => 'Файл не найден',
                    'success' => false
                ], 404);
            }

            $file->update([
                'name' => $validatedData['name']
            ]);

            return response()->json([
                'message' => 'Информация о файле успешно изменена',
                'data' => new FileResource($file),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения файла',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $file = File::find($id);

            if (!$file) {
                return response()->json([
                    'message' => 'Файл не найден',
                    'success' => false
                ], 404);
            }

            $file->delete();

            return response()->json([
                'message' => 'Файл успешно удален',
                'success' => true
            ], 204);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления файла',
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
}
