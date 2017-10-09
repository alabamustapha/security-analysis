@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">{{ $building->name }} - Responses by {{ $respondent->name }} </h3>
                    </div>
                    <div class="card-body">
                    
                    @foreach($responses as $response) 
                        <h3>{{ $response->question->body }}</h3>
                        
                        @if($response->question->type == "rating")
                          <p>{{ $response->value }}</p>
                        @else
                          <p>{{ $response->body }}</p>
                        @endif

                        @if(!empty($response->audios))
                            <a href="{{ route('response_audios', ['response' => $response->id]) }}" class="btn btn-primary">Download audios ({{count($response->audios)}})</a>
                        @endif

                        @if(!empty($response->videos))
                            <a href="{{ route('response_videos', ['response' => $response->id]) }}" class="btn btn-primary">Download videos ({{ count($response->videos)}})</a>
                        @endif

                    @endforeach  
                    
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