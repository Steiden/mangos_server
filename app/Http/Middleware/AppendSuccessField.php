<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppendSuccessField
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): \Symfony\Component\HttpFoundation\Response  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Получаем исходный ответ
        $response = $next($request);

        // Проверяем, является ли ответ JSON-объектом
        if ($response->isSuccessful() && $response->headers->get('Content-Type') === 'application/json') {
            // Если успешный статус, добавляем success => true
            $data = json_decode($response->getContent(), true);
            $data['success'] = true;
            $response->setContent(json_encode($data));
        } elseif ($response->headers->get('Content-Type') === 'application/json') {
            // Если статус не успешный, добавляем success => false
            $data = json_decode($response->getContent(), true);
            $data['success'] = false;
            $response->setContent(json_encode($data));
        }

        return $response;
    }
}
