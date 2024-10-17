<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'message' => 'События',
                'data' => EventResource::collection(Event::all()),
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ошибка получения событий',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $event = Event::create($request->all());
            return response()->json([
               'message' => 'Событие создано',
                'data' => new EventResource($event),
               'success' => true
            ], 201);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка создания события',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $event = Event::find($id);
            if (!$event) {
                return response()->json([
                   'message' => 'Событие не найдено',
                   'success' => false
                ], 404);
            }
            return response()->json([
               'message' => 'Событие',
                'data' => new EventResource($event),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка получения события',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $event = Event::find($id);
            if (!$event) {
                return response()->json([
                   'message' => 'Событие не найдено',
                   'success' => false
                ], 404);
            }
            $event->update($request->all());
            return response()->json([
               'message' => 'Событие изменено',
                'data' => new EventResource($event),
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка изменения события',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try {
            $event = Event::find($id);
            if (!$event) {
                return response()->json([
                   'message' => 'Событие не найдено',
                   'success' => false
                ], 404);
            }
            $event->delete();
            return response()->json([
               'message' => 'Событие удалено',
               'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json([
               'message' => 'Ошибка удаления события',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
