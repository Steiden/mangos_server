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
}
