@extends('layout.master')
@section('page-title')
 Login
@endsection
@section('page-content')
<div class="container login-container">
    <div class="row">
        <div class="col-md-6 offset-md-3 login-form-1">
            <h3>Account Login</h3>
            <form method="POST" action="{{ route('login') }}">
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
                    <label class="form-label">Password</label>
                    <input
                        type="password" 
                        name='password'                         
                        class="form-control @error('password') is-invalid @enderror" 
                        placeholder="Your Password *" 
                        >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" class="btnSubmit" value="Login" >
                </div>
               
            </form>
        </div>
    </div>
</div>
@endsection