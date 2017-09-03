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
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($officers as $officer) 
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $officer->name }}</td>
                            <td>{{ $officer->email }}</td>
                            <td>
                            <button class="btn btn-danger delete-officer" id="form{{ $officer->id }}">Delete</button>

                            <form id="delete-officer-form{{ $officer->id }}" action="{{ route('delete_officer', ['id' => $officer->id]) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                            <a class="btn btn-primary" href="{{ route('edit_officer', $officer->id) }}">Edit</a></td>
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

@section('scripts')
    <script type="text/javascript">

      $(document).ready(function(){

          $('button.delete-officer').click(function(event){
            
            event.preventDefault();

            var form = $(this).attr('id');
            swal({
              title: "Are you sure?",
              text: "Officer records will be deleted",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(){
              document.getElementById('delete-officer-' + form).submit();
            });
      
          });
          
      });
      
      
    </script>
@endsection