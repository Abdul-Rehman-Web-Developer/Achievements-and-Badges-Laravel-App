<?php

namespace App\Listeners;

use App\Models\Achievement;
use App\Events\CommentWritten;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentWrittenListener
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
     * Handle the event.
     *
     * @param  CommentWritten  $event
     * @return void
     */
    public function handle(CommentWritten $event)
    {
        $user = $event->user;
        $comments_count = $user->comments()->count();

        $achievement=null;
 
        if($comments_count >= 0  AND $comments_count <= 2)
            $achievement = Achievement::where('achievement','First Comment Written')->first();
                
        if($comments_count >= 3 AND $comments_count <= 4)
            $achievement = Achievement::where('achievement','3 Comments Written')->first();
  
        if($comments_count >= 5 AND $comments_count <= 9)
            $achievement = Achievement::where('achievement','5 Comments Written')->first();

        if($comments_count >= 10 AND $comments_count <= 19)
            $achievement = Achievement::where('achievement','10 Comments Written')->first();
        
        if($comments_count >= 20)
            $achievement = Achievement::where('achievement','20 Comments Written')->first();
                
        if(!$user->achievements()->where('achievement_id',$achievement->id)->first())
            $user->achievements()->attach([$achievement->id]);
    }
}
