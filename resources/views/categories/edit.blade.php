@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-6">
                  <div class="card">
                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Edit {{ $category->name }}</h3>
                    </div>
                    <div class="card-body">
                    
                       <div class="row">

                          <div class="col-md-12">
                                <form action="{{ route('update_category', $category->name) }}" method="post">
                                
                                {{ csrf_field() }}
                                {{ method_field('PUT')}}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="control-label">Name</label>

                                      <input id="name" type="text" class="form-control" name="name" value="{{ $category->name }}" required autofocus>

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
                                        @foreach($categories as $categoryItem)
                                            <option value="{{ $categoryItem->id }}" {{ $category->category_id == $categoryItem->id ? "selected" : ""}}>{{ $categoryItem->name }}</option>
                                        @endforeach
                                     </select>

                                      @if ($errors->has('category_id'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('category_id') }}</strong>
                                          </span>
                                      @endif
                                      
                                </div>

                                  <div class="form-group">
                                      <div class="col-md-6 col-md-offset-4">
                                          <button type="submit" class="btn btn-primary">
                                              Update category
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
                
              </div>
  </div>
  </section>

@endsection