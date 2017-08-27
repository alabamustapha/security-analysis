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
                    <h1>Installation</h1>
                  </div>
                  <p>Just a few click away to start.</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                
              
                  
                  <form id="login-form" class="form-horizontal" method="POST" action="{{ route('setup') }}">
                  {{ csrf_field() }}

                    

                    <!--  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        
                      <input id="name" type="text" class="input-material" name="name" value="{{ old('name') }}" required autofocus>
                      <label for="name" class="label-material">Name</label>


                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  
                    </div> -->
                    
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <input id="login-username" type="email" name="email" required="" class="input-material" value="{{ old('email') }}" required autofocus>
                      <label for="login-username" class="label-material">Email</label>

                      @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    </div>

                   <!--  <div class="form-group{{ $errors->has('license_code') ? ' has-error' : '' }}">
                      <input id="license_code" type="text" name="license_code" required class="input-material" value="{{ old('license_code') }}" required>
                      <label for="license_code" class="label-material">License Code</label>

                      @if ($errors->has('license_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('license_code') }}</strong>
                        </span>
                    @endif
                    </div> -->
                     <div class="form-group{{ $errors->has('root_url') ? ' has-error' : '' }}">
                      <input id="root_url" type="text" name="root_url" required class="input-material" value="{{ $root_url }}" required readonly>
                      <label for="root_url" class="label-material">Root url</label>

                      @if ($errors->has('root_url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('root_url') }}</strong>
                        </span>
                    @endif
                    </div>

                    
                    <!-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            
                        <input id="login-password" type="password" class="input-material" name="password" required>
                        <label for="login-password" class="label-material">Password</label>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        
                    </div> -->
                    
                    <!-- <div class="form-group">
                        
                            <input id="password-confirm" type="password" class="input-material" name="password_confirmation" required>
                            <label for="password-confirm" class="label-material">Confirm Password</label>
                    </div> -->
                    <button type="submit" class="btn btn-primary">Continue</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copyrights text-center">
        <p>Need Help or License Key? <a href="#" class="external">Contact us</a></p>
      </div>
    </div>
@endsection
