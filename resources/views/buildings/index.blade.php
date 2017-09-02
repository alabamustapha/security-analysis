@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-md-8">
                  <div class="card">
                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Buildings</h3>
                    </div>
                    <div class="card-body">
                      <a class="btn btn-primary" href="{{ url('buildings/create') }}" target="_blank">Add New Building</a>
                      <hr>
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($buildings as $building) 
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $building->name }}</td>
                            <td><button class="btn btn-danger">Delete</button>
                                <button class="btn btn-primary">Edit</button>
                                <a class="btn btn-primary" href="{{ url('buildings/' . $building->name) }}">Manage Questions</a>
                            </td>
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