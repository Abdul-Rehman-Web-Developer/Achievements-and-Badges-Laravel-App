<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AchievementSeeder::class);

        $lessons = Lesson::factory()
                    ->count(100)
                    ->create();

        $users = User::factory()
                    ->count(20)
                    ->create();        
        
    }
} 
