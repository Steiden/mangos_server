<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrganizationEmployeeResource;
use App\Models\OrganizationEmployee;
use Illuminate\Http\Request;

class OrganizationEmployeeController extends Controller
{
    public function index()
    {
        try {
            $organizationsEmployees = OrganizationEmployee::all();
            return response()->json([
                'success' => true,
                'message' => 'Сотрудники организаций',
                'data' => OrganizationEmployeeResource::collection($organizationsEmployees)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при получении списка сотрудников организаций',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'organization_id' => 'required|exists:organizations,id',
                'user_id' => 'required|exists:users,id',
            ]);

            $organizationEmployee = OrganizationEmployee::create($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Сотрудник организации создан',
                'data' => new OrganizationEmployeeResource($organizationEmployee)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при создании сотрудника организации',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $organizationEmployee = OrganizationEmployee::find($id);
            if (!$organizationEmployee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Сотрудник организации не найден'
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'Сотрудник организации',
                'data' => new OrganizationEmployeeResource($organizationEmployee)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при получении информации о сотруднике организации',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $organizationEmployee = OrganizationEmployee::find($id);
            if (!$organizationEmployee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Сотрудник организации не найден'
                ], 404);
            }

            $validatedData = $request->validate([
                'organization_id' => 'exists:organizations,id',
                'user_id' => 'exists:users,id',
            ]);

            $organizationEmployee->update($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Информация о сотруднике организации изменена',
                'data' => new OrganizationEmployeeResource($organizationEmployee)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка обновления сотрудника организации',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $organizationEmployee = OrganizationEmployee::find($id);
            if (!$organizationEmployee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Сотрудник организации не найден'
                ], 404);
            }

            $organizationEmployee->delete();
            return response()->json([
                'success' => true,
                'message' => 'Сотрудник организации удален'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при удалении сотрудника организации',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
