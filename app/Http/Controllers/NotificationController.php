<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Уведомления',
                'data' => NotificationResource::collection(Notification::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения уведомлений',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
