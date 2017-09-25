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
                            <td><button class="btn btn-danger delete-building" id="form{{ $building->id }}">Delete</button>

                            <form id="delete-building-form{{ $building->id }}" action="{{ route('delete_building', ['building' => $building->id]) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                                 <a class="btn btn-primary" href="{{ route('edit_building', ['building' => $building->id]) }}">Edit</a>
                                <a class="btn btn-primary" href="{{ url('buildings/' . $building->id) }}">Manage Questions</a>
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

@section('scripts')
    <script type="text/javascript">

      $(document).ready(function(){

          $('button.delete-building').click(function(event){
            
            event.preventDefault();

            var form = $(this).attr('id');
            swal({
              title: "Are you sure?",
              text: "Buidling and related records will be deleted",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(){
              document.getElementById('delete-building-' + form).submit();
            });
      
          });
          
      });
      
      
    </script>
@endsection