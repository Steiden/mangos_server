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
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
