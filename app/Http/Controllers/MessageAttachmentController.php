<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageAttachmentResource;
use App\Models\MessageAttachment;
use Illuminate\Http\Request;

class MessageAttachmentController extends Controller
{
    public function index()
    {
        try {
            $messageAttachments = MessageAttachment::all();
            return response()->json([
                "success" => true,
                "message" => "Вложения сообщений",
                "data" => MessageAttachmentResource::collection($messageAttachments)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Ошибка при получении вложений сообщений",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $messageAttachment = MessageAttachment::create($request->all());
            return response()->json([
                "success" => true,
                "message" => "Вложение сообщения создано",
                "data" => new MessageAttachmentResource($messageAttachment)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Ошибка при создании вложения сообщения",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $messageAttachment = MessageAttachment::find($id);
            if (!$messageAttachment) {
                return response()->json([
                    "success" => false,
                    "message" => "Вложение сообщения не найдено"
                ], 404);
            }
            return response()->json([
                "success" => true,
                "message" => "Вложение сообщения",
                "data" => new MessageAttachmentResource($messageAttachment)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Ошибка при получении вложения сообщения",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $messageAttachment = MessageAttachment::find($id);
            if (!$messageAttachment) {
                return response()->json([
                    "success" => false,
                    "message" => "Вложение сообщения не найдено"
                ], 404);
            }
            $messageAttachment->update($request->all());
            return response()->json([
                "success" => true,
                "message" => "Вложение сообщения изменено",
                "data" => new MessageAttachmentResource($messageAttachment)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Ошибка при изменении вложения сообщения",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $messageAttachment = MessageAttachment::find($id);
            if (!$messageAttachment) {
                return response()->json([
                    "success" => false,
                    "message" => "Вложение сообщения не найдено"
                ], 404);
            }
            $messageAttachment->delete();
            return response()->json([
                "success" => true,
                "message" => "Вложение сообщения удалено"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Ошибка при удалении вложения сообщения",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
