@extends('layouts.app')

@section('content')
<div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>Sign in</h1>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                
                  
                  <form id="login-form" class="form-horizontal" method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <input id="login-username" type="email" name="email" required="" class="input-material" value="{{ old('email') }}" required autofocus>
                      <label for="login-username" class="label-material">Email</label>

                      @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            
                            <input id="login-password" type="password" class="input-material" name="password" required>
                            <label for="login-password" class="label-material">Password</label>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        
                    </div>
                    <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                    <button type="submit" class="btn btn-primary">Log in</button>
                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                  </form><a class="forgot-pass" href="{{ route('password.request') }}">Forgot Your Password?</a><br><small>Do not have an account? </small><a href="{{ url('/register') }}" class="signup">Signup</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copyrights text-center">
        <p>Need Help? <a href="#" class="external">Contact admin</a></p>
      </div>
    </div>
@endsection
