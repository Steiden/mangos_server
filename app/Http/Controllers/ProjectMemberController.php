<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectMemberResource;
use App\Models\ProjectMember;
use Exception;
use Illuminate\Http\Request;

class ProjectMemberController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Участники проектов',
                'data' => ProjectMemberResource::collection(ProjectMember::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения участников проектов',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $projectMember = ProjectMember::create($request->all());
            return response()->json([
                'message' => 'Участник проекта создан',
                'data' => new ProjectMemberResource($projectMember),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания участника проекта',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $projectMember = ProjectMember::find($id);
            if (!$projectMember) {
                return response()->json([
                    'message' => 'Участник проекта не найден',
                    'success' => false
                ], 404);
            }
            $projectMember->update($request->all());
            return response()->json([
                'message' => 'Участник проекта изменен',
                'data' => new ProjectMemberResource($projectMember),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения участника проекта',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $projectMember = ProjectMember::find($id);
            if (!$projectMember) {
                return response()->json([
                    'message' => 'Участник проекта не найден',
                    'success' => false
                ], 404);
            }
            $projectMember->delete();
            return response()->json([
                'message' => 'Участник проекта удален',
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления участника проекта',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $projectMember = ProjectMember::find($id);
            if (!$projectMember) {
                return response()->json([
                    'message' => 'Участник проекта не найден',
                    'success' => false
                ], 404);
            }
            return response()->json([
                'message' => 'Участник проекта',
                'data' => new ProjectMemberResource($projectMember),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения участника проекта',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
