@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Officers</h3>
                    </div>
                    <div class="card-body">
                      <a href="{{ url('officers/create') }}" class="btn btn-primary"> Add Officer</a>
                      <hr>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($officers as $officer) 
                          <tr>
                            <td>{{ $officer->name }}</td>
                            <td>{{ $officer->email }}</td>
                            <td><button class="btn btn-danger">Delete</button><button class="btn btn-primary">Edit</button></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      
                      <!-- Modal-->
                    
                  </div>
                </div>
                
              </div>
  </div>
  </section>

@endsection