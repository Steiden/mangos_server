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
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $notification = Notification::find($id);

            if (!$notification) {
                return response()->json([
                    'message' => 'Уведомление не найдено',
                    'success' => false
                ], 404);
            }

            return response()->json([
                'message' => 'Уведомление',
                'data' => new NotificationResource($notification),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения уведомления',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $notification = Notification::create($request->all());

            return response()->json([
                'message' => 'Уведомление создано',
                'data' => new NotificationResource($notification),
                'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка создания уведомления',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $notification = Notification::find($id);

            if (!$notification) {
                return response()->json([
                    'message' => 'Уведомление не найдено',
                    'success' => false
                ], 404);
            }

            $notification->update($request->all());

            return response()->json([
                'message' => 'Уведомление изменено',
                'data' => new NotificationResource($notification),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка изменения уведомления',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $notification = Notification::find($id);

            if (!$notification) {
                return response()->json([
                    'message' => 'Уведомление не найдено',
                    'success' => false
                ], 404);
            }

            $notification->delete();

            return response()->json([
                'message' => 'Уведомление удалено',
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка удаления уведомления',
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
