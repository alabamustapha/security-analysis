@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
    <div class="row">
        
        <div class="col-lg-12">
          <div class="card">
            
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">Preview of {{ $building->name }} Report</h3>
            </div>
            <div class="card-body">
              
               <div class="row">

                  <div class="col-md-12">
                    <div id="report-preview">
                        {!! isset($building->report->body) ? makeReport($building->report->body) : '' !!}
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

