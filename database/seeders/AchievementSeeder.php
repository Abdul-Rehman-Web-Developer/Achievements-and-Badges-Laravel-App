<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement; 

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $achievements = [            
	        ['id' => 1, 'type' => 'LESSON_ACHIEVEMENT','achievement' =>'First Lesson Watched'],
	        ['id' => 2, 'type' => 'LESSON_ACHIEVEMENT','achievement' =>'5 Lessons Watched'],
	        ['id' => 3, 'type' => 'LESSON_ACHIEVEMENT','achievement' =>'10 Lessons Watched'],
	        ['id' => 4, 'type' => 'LESSON_ACHIEVEMENT','achievement' =>'25 Lessons Watched'],
	        ['id' => 5, 'type' => 'LESSON_ACHIEVEMENT','achievement' =>'50 Lessons Watched'],
	        ['id' => 6, 'type' => 'COMMENT_ACHIEVEMENT','achievement' =>'First Comment Written'],
	        ['id' => 7, 'type' => 'COMMENT_ACHIEVEMENT','achievement' =>'3 Comments Written'],
	        ['id' => 8, 'type' => 'COMMENT_ACHIEVEMENT','achievement' =>'5 Comments Written'],
	        ['id' => 9, 'type' => 'COMMENT_ACHIEVEMENT','achievement' =>'10 Comments Written'],
	        ['id' => 10, 'type' => 'COMMENT_ACHIEVEMENT','achievement' =>'20 Comments Written'],
	    ];

	    foreach ($achievements as $achievement) {
		    Achievement::updateOrCreate(['id' => $achievement['id']], $achievement);
		}

    }
}
