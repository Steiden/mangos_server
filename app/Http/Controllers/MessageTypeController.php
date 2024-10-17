<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageTypeResource;
use App\Models\MessageType;
use Exception;
use Illuminate\Http\Request;

class MessageTypeController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Типы сообщений',
                'data' => MessageTypeResource::collection(MessageType::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения типов сообщений',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $messageType = MessageType::create($request->all());
            return response()->json([
               'message' => 'Тип сообщения создан',
                'data' => new MessageTypeResource($messageType),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания нового типа сообщения',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $messageType = MessageType::find($id);
            if (!$messageType) {
                return response()->json([
                   'message' => 'Тип сообщения не найден',
                   'success' => false
                ], 404);
            }
            $messageType->update($request->all());
            return response()->json([
               'message' => 'Тип сообщения изменен',
                'data' => new MessageTypeResource($messageType),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения типа сообщения',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $messageType = MessageType::find($id);
            if (!$messageType) {
                return response()->json([
                   'message' => 'Тип сообщения не найден',
                   'success' => false
                ], 404);
            }
            $messageType->delete();
            return response()->json([
               'message' => 'Тип сообщения удален',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления типа сообщения',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $messageType = MessageType::find($id);
            if (!$messageType) {
                return response()->json([
                   'message' => 'Тип сообщения не найден',
                   'success' => false
                ], 404);
            }
            return response()->json([
               'message' => 'Тип сообщения',
                'data' => new MessageTypeResource($messageType),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения информации о типе сообщения',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
