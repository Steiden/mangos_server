<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Exception;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Организации',
                'data' => OrganizationResource::collection(Organization::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения организаций',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
