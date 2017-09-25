@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Buildings inspected by {{ $officer->name }} </h3>
                    </div>
                    <div class="card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($officer->inspectedBuildings() as $building) 
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $building->name }}</td>
                            <td>
                            <a class="btn btn-primary" href="{{ route('officer_building_respondents', ['officer' => $officer->id, 'building' => $building->id]) }}">View respondents</a>
                            </td>
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