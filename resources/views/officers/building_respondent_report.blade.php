@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
    <div class="row">
        
        <div class="col-lg-12">
          <div class="card">
            
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">Preview of {{ $building->name }} Report for {{ $respondent->name}}</h3>
            </div>
            <div class="card-body">
              
               <div class="row">

                  <div class="col-md-12">
                    <div id="report-preview">
                      @foreach($building->reports as $report)
                        {!! makeReport("<h2>" . $report->title . "</h2><br>" . $report->body, $respondent->id) !!}
                      @endforeach  
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

