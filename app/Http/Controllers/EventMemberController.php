<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventMemberResource;
use App\Models\EventMember;
use Exception;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Участники событий',
                'data' => EventMemberResource::collection(EventMember::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения участников событий',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
