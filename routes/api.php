<?php

use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutomationActionController;
use App\Http\Controllers\AutomationConditionController;
use App\Http\Controllers\AutomationController;
use App\Http\Controllers\AutomationEditorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatMemberController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\ChatModeratorController;
use App\Http\Controllers\ComparisonTypeController;
use App\Http\Controllers\ConditionObjectController;
use App\Http\Controllers\ConditionValueObjectController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventMemberController;
use App\Http\Controllers\EventRepeatController;
use App\Http\Controllers\ExecutionStatusController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileTypeController;
use App\Http\Controllers\MessageAttachmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessageTypeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationEmployeeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectMemberController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskAttachmentController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskMemberController;
use App\Http\Controllers\TaskPerformerController;
use App\Http\Controllers\TaskPriorityController;
use App\Http\Controllers\TaskTagController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Routes for:
// activity_types
// automation_actions
// automation_conditions
// automations
// automation_editors
// categories
// chats
// chat_members
// comparison_types
// condition_objects
// condition_value_objects
// divisions
// events
// event_members
// event_repeats
// execution_statuses
// files
// file_types
// messages
// message_attachments
// message_types
// notifications
// organizations
// organization_employees
// posts
// projects
// project_members
// roles
// tags
// task_attachments
// tasks
// task_performers
// task_priorities
// task_tags
// users

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('refresh', [AuthController::class, 'refresh']);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('activity_types', ActivityTypeController::class);
    // Route::apiResource('automation_actions', AutomationActionController::class);
    // Route::apiResource('automation_conditions', AutomationConditionController::class);
    // Route::apiResource('automations', AutomationController::class);
    // Route::apiResource('automation_editors', AutomationEditorController::class);
    Route::apiResource('categories', CategoryController::class);
    // Route::apiResource('chats', ChatController::class);
    // Route::apiResource('chat_members', ChatMemberController::class);
    // Route::apiResource('comparison_types', ComparisonTypeController::class);
    // Route::apiResource('condition_objects', ConditionObjectController::class);
    // Route::apiResource('condition_value_objects', ConditionValueObjectController::class);
    Route::apiResource('divisions', DivisionController::class);
    // Route::apiResource('events', EventController::class);
    // Route::apiResource('event_members', EventMemberController::class);
    // Route::apiResource('event_repeats', EventRepeatController::class);
    Route::apiResource('execution_statuses', ExecutionStatusController::class);
    // Route::apiResource('files', FileController::class);
    // Route::apiResource('file_types', FileTypeController::class);
    // Route::apiResource('messages', MessageController::class);
    // Route::apiResource('message_attachments', MessageAttachmentController::class);
    // Route::apiResource('message_types', MessageTypeController::class);
    Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('organizations', OrganizationController::class);
    Route::apiResource('organization_employees', OrganizationEmployeeController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('project_members', ProjectMemberController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('tags', TagController::class);
    // Route::apiResource('task_attachments', TaskAttachmentController::class);
    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('task_members', TaskMemberController::class);
    Route::apiResource('task_priorities', TaskPriorityController::class);
    Route::apiResource('task_tags', TaskTagController::class);
    Route::apiResource('users', UserController::class);
});