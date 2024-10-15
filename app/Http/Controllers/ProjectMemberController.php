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
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
