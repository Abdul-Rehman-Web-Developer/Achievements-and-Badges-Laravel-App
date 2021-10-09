<?php

namespace App\Listeners;

use App\Models\Achievement;
use App\Events\LessonWatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LessonWatchedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the eventq     
     * @param  LessonWatched  $event
     * @return void
     */
    public function handle(LessonWatched $event)
    {
        $user = $event->user;
        $lessons_count = $user->lessons()->count();
        $achievement=null;
 
        if($lessons_count >= 0  AND $lessons_count <= 4)
            $achievement = Achievement::where('achievement','First Lesson Watched')->first();
                
        if($lessons_count >= 5 AND $lessons_count <= 9)
            $achievement = Achievement::where('achievement','5 Lessons Watched')->first();
  
        if($lessons_count >= 10 AND $lessons_count <= 24)
            $achievement = Achievement::where('achievement','10 Lessons Watched')->first();

        if($lessons_count >= 25 AND $lessons_count <= 49)
            $achievement = Achievement::where('achievement','25 Lessons Watched')->first();

        if($lessons_count >= 50)
            $achievement = Achievement::where('achievement','50 Lessons Watched')->first();
            
        
        if(!$user->achievements()->where('achievement_id',$achievement->id)->first())
            $user->achievements()->attach([$achievement->id]);
    }
}
