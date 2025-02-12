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
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'activity_type_id' => 'required|integer|exists:activity_types,id',
                'user_id' => 'required|integer|exists:users,id'
            ]);

            $organization = Organization::create($validatedData);

            return response()->json([
                'message' => 'Организация создана',
                'data' => new OrganizationResource($organization),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания организации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $organization = Organization::find($id);

            if (!$organization) {
                return response()->json([
                    'message' => 'Организация не найдена',
                    'success' => false
                ], 404);
            }

            return response()->json([
                'message' => 'Организация',
                'data' => new OrganizationResource($organization),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения организации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $organization = Organization::find($id);

            if (!$organization) {
                return response()->json([
                    'message' => 'Организация не найдена',
                    'success' => false
                ], 404);
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255'
            ]);

            $organization->update($validatedData);

            return response()->json([
                'message' => 'Организация изменена',
                'data' => new OrganizationResource($organization),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения организации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $organization = Organization::find($id);

            if (!$organization) {
                return response()->json([
                    'message' => 'Организация не найдена',
                    'success' => false
                ], 404);
            }

            $organization->delete();

            return response()->json([
                'message' => 'Организация удалена',
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления организации',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
