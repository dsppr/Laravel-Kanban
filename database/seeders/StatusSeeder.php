<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    public function run()
    {
        // Seed data for project statuses
        DB::table('project_statuses')->insert([
            ['name' => 'To Do'],
            ['name' => 'In Progress'],
            ['name' => 'Done'],
        ]);

        // Seed data for task statuses
        DB::table('task_statuses')->insert([
            ['name' => 'To Do'],
            ['name' => 'In Progress'],
            ['name' => 'Done'],
        ]);
    }
}
