@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-close">
                      <div class="dropdown">
                        <button type="button" id="closeCard" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard" class="dropdown-menu has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i>Add New Office</a></div>
                      </div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Officers</h3>
                    </div>
                    <div class="card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark Taloy</td>
                            <td>officer1@gmail.com</td>
                            <td><button class="btn btn-danger">Delete</button><button class="btn btn-primary">Edit</button></td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>John snow</td>
                            <td>john@snow.com</td>
                            <td><button class="btn btn-danger">Delete</button><button class="btn btn-primary">Edit</button></td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Larry partner</td>
                            <td>larry@gmail.com</td>
                            <td><button class="btn btn-danger">Delete</button><button class="btn btn-primary">Edit</button></td>
                          </tr>
                        </tbody>
                      </table>
                      
                      <!-- Modal-->
                      <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                        <div role="document" class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 id="exampleModalLabel" class="modal-title">Signin Modal</h4>
                              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                              <p>List of all officers</p>
                              <form action="{{ url('/officers') }}" method="post">
                                
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="control-label">Name</label>

                                      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                      @if ($errors->has('name'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @endif
                                      
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">E-Mail Address</label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                      <label for="password" class="control-label">Password</label>

                                          <input id="password" type="password" class="form-control" name="password" required>

                                          @if ($errors->has('password'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('password') }}</strong>
                                              </span>
                                          @endif
                                  </div>

                                  <div class="form-group">
                                      <label for="password-confirm" class="control-label">Confirm Password</label>

                                      
                                          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                      
                                  </div>

                                  <div class="form-group">
                                      <div class="col-md-6 col-md-offset-4">
                                          <button type="submit" class="btn btn-primary">
                                              Add officer
                                          </button>
                                      </div>
                                  </div>
                                
                              </form>
                            
                    </div>
                  </div>
                </div>
                    </div>
                  </div>
                </div>
                
              </div>
  </div>
  </section>

@endsection