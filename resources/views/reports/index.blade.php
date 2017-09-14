@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-md-8">
                  <div class="card">
                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Buildings Report</h3>
                    </div>
                    <div class="card-body">
                      
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
                            <td>
                                <a class="btn btn-primary" href="{{ url('buildings/' . $building->name . '/report' ) }}">Edit</a>
                                <a class="btn btn-primary" href="{{ url('buildings/' . $building->name . '/report_preview') }}">Preview</a>
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