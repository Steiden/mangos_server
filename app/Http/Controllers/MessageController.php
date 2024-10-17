<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'Сообщения',
                'data' => MessageResource::collection(Message::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения сообщений',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $message = Message::create($request->all());
            return response()->json([
               'message' => 'Сообщение создано',
                'data' => new MessageResource($message),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания сообщения',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $message = Message::find($id);
            if (!$message) {
                return response()->json([
                   'message' => 'Сообщение не найдено',
                    'error' => 'Message not found'
                ], 404);
            }
            return response()->json([
               'message' => 'Сообщение',
                'data' => new MessageResource($message),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения сообщения',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $message = Message::find($id);
            if (!$message) {
                return response()->json([
                   'message' => 'Сообщение не найдено',
                    'error' => 'Message not found'
                ], 404);
            }
            $message->update($request->all());
            return response()->json([
               'message' => 'Сообщение изменено',
                'data' => new MessageResource($message),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения сообщения',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $message = Message::find($id);
            if (!$message) {
                return response()->json([
                   'message' => 'Сообщение не найдено',
                    'error' => 'Message not found'
                ], 404);
            }
            $message->delete();
            return response()->json([
               'message' => 'Сообщение удалено',
               'success' => true
            ], 204);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления сообщения',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
