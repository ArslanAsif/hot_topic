@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="opacity: 0.9 ">
            <div class="panel panel-default" style="color: black">
                <div class="panel-heading">
                    <span class="fa fa-lock"></span>
                    Login
                    {{--<a href="#" class="pull-right">Admin</a>--}}
                </div>

                <div class="panel-body">

                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="" style="text-align: center"><span class="fa fa-users" style="color: royalblue"></span> Social Network</h3></br>
                            </div>
                        </div>


                        <div class="form-group">
                            <a href="{{ url('auth/facebook') }}" class="btn btn-default form-control"><span class="fa fa-facebook-square" style="color: royalblue"></span> Facebook</a>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('auth/google') }}" class="btn btn-default form-control"><span class="fa fa-google" style="color: red"></span> Google</a>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('auth/twitter') }}" class="btn btn-default form-control"><span class="fa fa-twitter" style="color: #00b3ee"></span> Twitter</a>
                        </div>
                    </div>

                    <div class="col-md-7" id="login-input">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="" style="text-align: center"><span class="fa fa-envelope" style="color: darkorange"></span> Email</h3></br>
                            </div>
                        </div>

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <div class="col-md-12">
                                    <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                <div class="col-md-12">
                                    <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="fa fa-unlock"></span>
                                        Login
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>

                        </form>

                        <h4>Not a member?</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-success pull-right form-control" href="{{url('/register')}}"><span class="fa fa-share"></span> Click here to register with email</a>
                            </div>
                        </div>
                        <h4 style="text-align: center">OR</h4>
                        <p>Click on any social network button on left to automatically login with social network, no need to register!</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
