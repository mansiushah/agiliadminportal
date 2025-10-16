@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="login_box">
    <div class="login_top text-center mb-3">
            @include('flash-message')
        <h2>Admin Portal</h2>
        <P>Sign in to your account</P>
    </div>
    <div class="login_info">
        <form method="post" href="{{ route('login.submit') }}">
            @csrf
            <div class="form-group">
                <label for="">Email Address</label>
                <input type="text" class="form-control" placeholder="your@emailid.com" name="email">
            </div>
            <div class="form-group position-relative">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Your Password" name="password">
                <a href="#" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></a>
            </div>


            <button class="btn btn-primary w-100 login_btn">Sign In</button>
        </form>
    </div>
</div>
@endsection
