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
            $projects = Project::paginate(25);

            return response()->json([
                'message' => 'Проекты',
                'data' => ProjectResource::collection($projects->items()),
                'pagination' => [
                    'total' => $projects->total(),
                    'per_page' => $projects->perPage(),
                    'current_page' => $projects->currentPage(),
                    'last_page' => $projects->lastPage(),
                    'next_page_url' => $projects->nextPageUrl(),
                    'prev_page_url' => $projects->previousPageUrl(),
                ],
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения проектов',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $project = Project::find($id);

            if (!$project) {
                return response()->json([
                    'message' => 'Проект не найден',
                    'success' => false
                ], 404);
            }

            return response()->json([
                'message' => 'Проект',
                'data' => new ProjectResource($project),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения проекта',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $project = Project::create($request->all());

            return response()->json([
                'message' => 'Проект создан',
                'data' => new ProjectResource($project),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания проекта',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $project = Project::find($id);

            if (!$project) {
                return response()->json([
                    'message' => 'Проект не найден',
                    'success' => false
                ], 404);
            }

            $project->update($request->all());

            return response()->json([
                'message' => 'Проект изменен',
                'data' => new ProjectResource($project),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения проекта',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $project = Project::find($id);

            if (!$project) {
                return response()->json([
                    'message' => 'Проект не найден',
                    'success' => false
                ], 404);
            }

            $project->delete();

            return response()->json([
                'message' => 'Проект удален',
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления проекта',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
