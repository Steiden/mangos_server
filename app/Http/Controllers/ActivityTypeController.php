<?php

namespace App\Http\Controllers;

use App\Models\ActivityType;
use Exception;
use Illuminate\Http\Request;

class ActivityTypeController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Success',
                'data' => ActivityType::all()
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => '',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
