@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-6">
                  <div class="card">
                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Edit {{ $building->name }}</h3>
                    </div>
                    <div class="card-body">
                      
                       <div class="row">

                          <div class="col-md-12">
                                <form action="{{ route('update_building', ['budilding' => $building->name]) }}" method="post">
                                
                                {{ csrf_field() }}
                                {{ method_field("PUT") }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="control-label">Name</label>

                                      <input id="name" type="text" class="form-control" name="name" value="{{ $building->name }}" required autofocus>

                                      @if ($errors->has('name'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @endif
                                      
                                </div>


                                  <div class="form-group">
                                      
                                      <button type="submit" class="btn btn-primary">
                                          Update
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