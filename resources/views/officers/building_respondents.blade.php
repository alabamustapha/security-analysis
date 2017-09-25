@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">{{ $building->name }} - {{ $officer->name }} </h3>
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
                         @foreach($building_respondents as $respondent) 
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $respondent->name }}</td>
                            <td>
                            <button class="btn btn-danger delete-respondent" id="form{{ $respondent->id }}">Delete</button>

                            <form id="delete-respondent-form{{ $respondent->id }}" action="{{ route('delete_respondent', ['id' => $respondent->id]) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                            <a class="btn btn-primary" href="{{ route('respondent_building_responses', ['officer' => $officer->id, 'building' => $building->id, 'respondent' => $respondent->id]) }}">View responses</a>
                            <a class="btn btn-primary" href="{{ route('respondent_building_report', ['officer' => $officer->id, 'building' => $building->id, 'respondent' => $respondent->id]) }}">Preview report</a>
                            <a class="btn btn-success" href="{{ route('download_respondent_building_report', ['building' => $building->id, 'respondent' => $respondent->id]) }}">Download report</a>
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

          $('button.delete-respondent').click(function(event){
            
            event.preventDefault();

            var form = $(this).attr('id');
            swal({
              title: "Are you sure?",
              text: "Respondent records will be deleted",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(){
              document.getElementById('delete-respondent-' + form).submit();
            });
      
          });
          
      });
      
      
    </script>
@endsection