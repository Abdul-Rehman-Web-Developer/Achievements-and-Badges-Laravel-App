@extends('layout.master')
@section('page-title')
 Reset Password
@endsection
@section('page-content')
<div class="container login-container">
    <div class="row">
        <div class="col-md-6 offset-md-3 login-form-1">
            <h3>Reset Password</h3>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input
                        type="text" 
                        name='email'                        
                        class="form-control @error('email') is-invalid @enderror" 
                        value="{{ $request->email }}"
                        >
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input
                        type="password" 
                        name='password'                         
                        class="form-control @error('password') is-invalid @enderror" 
                        placeholder="Your New Password *" 
                        >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input
                        type="password" 
                        name='password_confirmation'                         
                        class="form-control" 
                        placeholder="Confirm Password *" 
                        >
                    
                </div>
                <div class="form-group">
                    <input type="submit" class="btnSubmit" value="Reset Password" >
                </div>
                <div class="form-group">
                    <a href="{{route('login')}}" class="ForgetPwd">Account Login?</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection