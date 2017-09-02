@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-6">
                  <div class="card">
                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Create New (Sub) Category</h3>
                    </div>
                    <div class="card-body">
                      
                       <div class="row">

                          <div class="col-md-12">
                                <form action="{{ url('categories') }}" method="post">
                                
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

                                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                    <label for="name" class="control-label">Main Category</label>

                                     <select name="category_id" class="form-control">
                                        <option value="">Not a sub category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                     </select>

                                      @if ($errors->has('category_id'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('category_id') }}</strong>
                                          </span>
                                      @endif
                                      
                                </div>


                                  <div class="form-group">
                                      
                                      <button type="submit" class="btn btn-primary">
                                          Add category
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