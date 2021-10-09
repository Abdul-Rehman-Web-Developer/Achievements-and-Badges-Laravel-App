@extends('layout.master')
@section('page-title')
 Dashboard
@endsection
@section('page-content')
<div class="container mb-5 mt-2">
   
    <div class="row">
        <div class="col-md-12">
            <h3 class="mt-4 mb-2">
                <i class="fas fa-chart-bar"></i>
                Progress
            </h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <table class="table table-striped">
                <tr>
                    <td>
                        <h5 style="font-weight:bold">Badge</h5>
                    </td>
                    <td>
                        {{$userBadge}}
                    </td>
                </tr>
            </table>
        </div>
         <div class="col-md-4">
            <table class="table table-striped">
                <tr>
                    <td>
                        <h5 style="font-weight:bold">Lessons Watched</h5>
                    </td>
                    <td>
                        {{$lessonsWatched}} 
                    </td>
                </tr>
            </table>
        </div>
         <div class="col-md-4">
            <table class="table table-striped">
                <tr>
                    <td>
                        <h5 style="font-weight:bold">Comments Written</h5>
                    </td>
                    <td>
                        {{$commentsWritten}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">        
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item achievements-heading">
                    <h5 >
                    Lessons Watched Achievements
                    </h5>
                </li>
                @foreach($userLessonAchievements as $achievement)
                <li class="list-group-item">
                    <div class="achievement-title">
                        {{$achievement->achievement}}
                    </div>
                    <div class="achievement-date">
                        {{\Carbon\Carbon::parse($achievement->achieved_date)->format("F j, Y - g:i A")}}
                    </div>
                </li>
                @endforeach
                
            </ul>
        </div>
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item achievements-heading">
                    <h5 >
                    Comments Written Achievements
                    </h5>
                </li>
                @foreach($userCommentAchievements as $achievement)
                <li class="list-group-item">
                    <div class="achievement-title">
                        {{$achievement->achievement}}
                    </div>
                    <div class="achievement-date">
                        {{\Carbon\Carbon::parse($achievement->achieved_date)->format("F j, Y - g:i A")}}
                    </div>
                </li>
                @endforeach
            </ul>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="mt-5 mb-2">
                <i class="fas fa-book-open"></i>
                Lessons
            </h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            
        @foreach($lessons as $lesson)
        <nav class="lesson-navbar">
            <div class="nav nav-tabs" id="nav-tab-{{$lesson->id}}" role="tablist">
                <a class="nav-link active" id="nav-lesson-tab-{{$lesson->id}}" data-toggle="tab" href="#nav-lesson-{{$lesson->id}}" role="tab" aria-controls="nav-lesson-{{$lesson->id}}" aria-selected="true">Lesson</a>
                <a class="nav-link" id="nav-comments-tab-{{$lesson->id}}" data-toggle="tab" href="#nav-comments-{{$lesson->id}}" role="tab" aria-controls="nav-comments-{{$lesson->id}}" aria-selected="false">Comments</a>
            </div>
        </nav>
        <div class="tab-content lesson-content" id="nav-tabContent-{{$lesson->id}}">
            <div class="tab-pane fade show active" id="nav-lesson-{{$lesson->id}}" role="tabpanel" aria-labelledby="nav-lesson-tab">
                <div>
                    <span class="lesson-count">
                        {{$lesson->id}}
                    </span>
                    <a href="{{ route('comment_index',['lesson_id'=>$lesson->id]) }}" class="btn btn-primary btn-sm float-right">
                        Write Comment
                    </a>
                  
                    <?php $watched =false; ?>
                    @foreach($userLessonsWatched as $lessonWatched)
                        @if($lessonWatched->user_id == auth()->user()->id AND $lessonWatched->lesson_id == $lesson->id)
                            <?php $watched=true; ?>                            
                        @endif
                    @endforeach
                    @if($watched)
                            <i class="fas fa-eye float-right lesson-watch-status lesson-watched"  title="Lesson Watched"></i>
                    @else
                        <a href="{{ route('lesson_watched',['lesson_id'=>$lesson->id]) }}">
                            <i class="fas fa-eye-slash float-right lesson-watch-status" title="click to Watch"></i>
                        </a>
                    @endif
                </div>
                <div style="clear:both">
                    <hr>
                    {{$lesson->title}}
                </div>   
                
            </div>
            <div class="tab-pane fade" id="nav-comments-{{$lesson->id}}" role="tabpanel" aria-labelledby="nav-comments-tab">
                 @foreach($commentsList as $comment)
                    @if($comment['lesson_id'] == $lesson->id)
                    <div class="panel panel-default mb-4" style="background-color: white;padding:20px">
                        <div class="panel-heading" >
                          <div class="row">
                            <div class="col-md-8" style="font-weight: bold">
                                {{$comment['commented_by']}}
                            </div>    
                            <div class="col-md-4" style="text-align: right;font-size: 13px;color: #666;">
                                {{$comment['comment_date']}}    
                            </div>    
                          </div>
                        </div>
                      
                        <div class="panel-body" >
                              <hr >
                            {{$comment['comment']}}
                        </div>
                    </div>
                    @endif
                @endforeach             
            </div>
        </div>
        
        @endforeach



        </div>
    </div>

</div>
@endsection