<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::create([
            'title' => 'مهمة اختبار 1',
            'description' => 'هذه مهمة اختبارية',
            'is_completed' => false,
            'user_id' => 1,
        ]);
        Task::create([
            'title' => 'مهمة اختبار 2',
            'description' => 'مهمة أخرى',
            'is_completed' => true,
            'user_id' => 1,
        ]);
    }
}
