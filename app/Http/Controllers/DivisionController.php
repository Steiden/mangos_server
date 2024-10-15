<?php

namespace App\Http\Controllers;

use App\Http\Resources\DivisionResource;
use App\Models\Division;
use Exception;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Подразделения',
                'data' => DivisionResource::collection(Division::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения подразделений',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
