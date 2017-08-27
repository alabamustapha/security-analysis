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
                    <h1>Register Admin Account</h1>
                  </div>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">

                 <form id="register-form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="role" value="admin">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <input id="name" type="text" name="name" required class="input-material" value="{{ old('name') }}">
                      <label for="name" class="label-material">Name</label>

                       @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <input id="email" type="email" name="email" required class="input-material" value="{{ old('email') }}">
                      <label for="email" class="label-material">Email Address</label>

                       @if($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <input id="password" type="password" name="password" required class="input-material" value="{{ old('password') }}">
                      <label for="password" class="label-material">password</label>
                       @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <input id="password_confirmation" type="password" name="password_confirmation" required class="input-material">
                      <label for="password_confirmation" class="label-material">Confirm password</label>
                    </div>
                    
                    <input id="register" type="submit" value="Register" class="btn btn-primary">
                  </form>
            
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
