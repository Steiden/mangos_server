<?php

namespace Database\Seeders;

use App\Models\ActivityType;
use App\Models\Automation;
use App\Models\AutomationAction;
use App\Models\AutomationCondition;
use App\Models\AutomationEditor;
use App\Models\Category;
use App\Models\Chat;
use App\Models\ChatMember;
use App\Models\ChatModerator;
use App\Models\ComparisonType;
use App\Models\ConditionObject;
use App\Models\ConditionValueObject;
use App\Models\Division;
use App\Models\Event;
use App\Models\EventMember;
use App\Models\EventRepeat;
use App\Models\ExecutionStatus;
use App\Models\File;
use App\Models\FileType;
use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\MessageType;
use App\Models\Notification;
use App\Models\Organization;
use App\Models\OrganizationEmployee;
use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Role;
use App\Models\Tag;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\TaskPerformer;
use App\Models\TaskPriority;
use App\Models\User;
use Database\Factories\ConditionValueObjectFactory;
use Database\Factories\FileTypeFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::createOrFirst([
            'name' => 'admin'
        ]);
        Role::createOrFirst([
            'name' => 'user'
        ]);

        ActivityType::factory(10)->create();
        Organization::factory(10)->create();
        Division::factory(10)->create();
        Post::factory(10)->create();
        User::factory(10)->create();
        OrganizationEmployee::factory(10)->create();

        ChatMember::factory(10)->create();
        ChatModerator::factory(10)->create();
        Chat::factory(10)->create();
        
        Category::factory(10)->create();
        Tag::factory(10)->create();
        ExecutionStatus::factory(10)->create();

        Project::factory(10)->create();
        ProjectMember::factory(10)->create();

        FileType::factory(10)->create();
        File::factory(10)->create();

        TaskPriority::factory(10)->create();
        Task::factory(10)->create();
        TaskPerformer::factory(10)->create();
        TaskAttachment::factory(10)->create();

        EventRepeat::factory(10)->create();
        Event::factory(10)->create();
        EventMember::factory(10)->create();

        ComparisonType::factory(10)->create();
        ConditionObject::factory(10)->create();
        ConditionValueObject::factory(10)->create();
        AutomationCondition::factory(10)->create();
        AutomationAction::factory(10)->create();
        Automation::factory(10)->create();
        AutomationEditor::factory(10)->create();
        
        MessageType::createOrFirst([
            'name' => 'user'
        ]);
        MessageType::createOrFirst([
            'name' => 'task'
        ]);
        MessageType::createOrFirst([
            'name' => 'chat'
        ]);
        Message::factory(10)->create();
        MessageAttachment::factory(10)->create();
        
        Notification::factory(10)->create();
    }
}
