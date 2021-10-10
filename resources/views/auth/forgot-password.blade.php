@extends('layout.master')
@section('page-title')
 Forgot Password
@endsection
@section('page-content')
<div class="container login-container">
    <div class="row">
        <div class="col-md-6 offset-md-3 login-form-1">
            <h3>Forgot Password</h3>
            @if(session('status'))
             <div class="alert alert-success">
                 {{session('status')}}
             </div>
            @endif
            <form method="POST" action="{{ route('password.request') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input
                        type="text" 
                        name='email'                        
                        class="form-control @error('email') is-invalid @enderror" 
                        placeholder="Your Email *" 
                        value="{{ old('email') }}" 
                        autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              
                <div class="form-group">
                    <input type="submit" class="btnSubmit" value="Send Recovery Email" >
                </div>
                <div class="form-group">
                    <a href="{{route('register')}}" class="ForgetPwd">Register Account?</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection