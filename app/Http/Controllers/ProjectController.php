<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Проекты',
                'data' => ProjectResource::collection(Project::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения проектов',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
