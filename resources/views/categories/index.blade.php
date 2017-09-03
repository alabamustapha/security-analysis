@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-12">
                  <div class="card">
                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Categories</h3>

                    </div>
                    <div class="card-body">
                      <a class="btn btn-primary" href="{{ url('categories/create') }}">Add New Category</a>
                      <hr>
                      <table class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Main Category</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($categories as $category) 
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->main_category->name or '' }}</td>
                            <td><button class="btn btn-danger">Delete</button><button class="btn btn-primary">Edit</button></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                            
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