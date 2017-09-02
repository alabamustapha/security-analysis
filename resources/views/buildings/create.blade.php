@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-6">
                  <div class="card">
                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Create New Building Type</h3>
                    </div>
                    <div class="card-body">
                      
                       <div class="row">

                          <div class="col-md-12">
                                <form action="{{ url('buildings') }}" method="post">
                                
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


                                  <div class="form-group">
                                      
                                      <button type="submit" class="btn btn-primary">
                                          Continue
                                      </button>
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
                
              </div>
  </div>
  </section>

@endsection