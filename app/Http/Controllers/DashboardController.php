<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Models\Lesson;
use App\Models\Comment;
use App\Models\User;
use Auth;
use DB;

class DashboardController extends Controller
{

	/*
	* Comment Page
	*/
	public function commentIndex(Request $request){
		if(!$lesson= Lesson::find($request->lesson_id)){
			return redirect()->route('dashboard');
		}
		return view('comment',compact('lesson'));
	}

	/*
	* Dashboard Page
	*/
	public function dashboardIndex(Request $request){
		$user = User::find(auth()->user()->id);

        $lessons = Lesson::all();
    
        $userLessonsWatched= $user->lessons()->select('user_id','lesson_id')->get();
	
		$userLessonAchievements =$user->achievements()
									->select('achievements.achievement','achievement_user.achieved_at')
									->where('achievements.type','LESSON_ACHIEVEMENT')
									->get();

	    $userCommentAchievements =$user->achievements()
									->select('achievements.achievement','achievement_user.achieved_at')
									->where('achievements.type','COMMENT_ACHIEVEMENT') 
									->get();

		
		$lessonsWatched = $user->watched()->count();
		$commentsWritten =$user->comments()->count();
		
		$commentsList = $this->comments();
		        
        $userBadge=$this->userBadge($user);
		            
		return view('dashboard',
								compact(
									[
										'lessons',
										'commentsList',
										'lessonsWatched',
										'commentsWritten',
										'userLessonsWatched',
										'userLessonAchievements',
										'userCommentAchievements',
										'userBadge',
									]
								)
		);
	}

	
    /* Process the logout request */
	public function logout(Request $request) {
	        Auth::logout();
	        return redirect('/login');
	}

	/* Lesson watched */
	public function lessonWatched(Request $request) {
		$user = User::find(auth()->user()->id);

		if(!$lesson= Lesson::find($request->lesson_id)){
			return redirect()->route('dashboard');
		}

		if($user->lessons()->where('lesson_id',$lesson->id)->first()){
			return redirect()->route('dashboard');
		}
		
		$user->lessons()->attach([$lesson->id]);
		event(new LessonWatched($user));
		return redirect()->route('dashboard');
	}

	/* Comment written */
	public function commentWritten(Request $request) {
		
		Validator::make($request->all(), [
            'comment' => 'required|min:6|max:500',
            'lesson_id' => 'required|exists:lessons,id'            
        ])->validate();

		$user = User::find(auth()->user()->id);

		$lesson= Lesson::find($request->lesson_id);
			
		$comment = new Comment;
		$comment->body = $request->comment;
		$comment->user_id = $user->id;
		$comment->lesson_id = $request->lesson_id;
		$comment->save();

		event(new CommentWritten($user));
		return redirect()->route('dashboard');
	}

	private function userBadge(User $user){
		$userAchievemnts = $user->achievements()->count();

		$userBadge = "Beginner";

		if($userAchievemnts >= 4 AND $userAchievemnts <= 7)
            $userBadge = "Intermediate";

        if($userAchievemnts >= 8 AND $userAchievemnts <= 9)
            $userBadge = "Advanced";

        if($userAchievemnts >= 10)
            $userBadge = "Master";

        return $userBadge;
	}

	private function comments(){
		$commentsList = [];
		$comments = Comment::all();

		foreach ($comments as $comment) {
			$commentUser = User::find($comment->user_id);
			array_push($commentsList, 
										[
											'lesson_id' => $comment->lesson_id,
											'commented_by' => $commentUser->name,
											'comment' => $comment->body,
											'comment_date' => $comment->created_at->format("F j, Y - g:i A")
										]
			);
		}

		return $commentsList;
	}
	
}
