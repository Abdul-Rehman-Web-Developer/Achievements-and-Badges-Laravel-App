@extends('layout.master')
@section('page-title')
 Comment
@endsection
@section('page-content')
<div class="container mb-5 mt-2">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mt-4 mb-2">
                <i class="fas fa-comment-o"></i>
                Comment
            </h3>
            <hr>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-6 offset-md-3 mt-5">
    		<div class="mb-5">
                    <h5 class="font-weight-bold">Lesson ({{$lesson->id}})</h5>
                    <p> 
                        {{$lesson->title}}
                    </p>
                   
            </div>
            @error('lesson_id')
                <div class="alert alert-danger" role="alert">
				  {{$message}}
				</div>
            @enderror
    		<form method="POST" action="{{route('write_comment')}}">
    			@csrf
    			<input type="hidden" name="lesson_id" value="{{$lesson->id}}">
    			
                <div class="form-group">
                    <label class="form-label font-weight-bold">Comment</label>
                    <textarea
                    	name='comment'                         
                        class="form-control @error('comment') is-invalid @enderror" 
                        placeholder="Write Comment *"

                        >{{ old('comment') }}</textarea>
                    @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>
                <div class="form-group">
                	<button type="submit" class="btn btn-primary">
                		Submit
                		<i class="fa fa-paper-plane"></i>
                    </button>
                </div>
    		</form>
    	</div>
    </div>
</div>
@endsection