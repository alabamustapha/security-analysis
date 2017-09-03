@extends("layouts.admin")

@section("content")

 <section class="dashboard-header">
    <div class="container-fluid">          
          <div class="row">
                
                <div class="statistics col-lg-3">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-orange"><i class="fa fa-users"></i></div>
                    <div class="text"><strong>{{ $officers_count }}</strong><br><small>Officers</small></div>
                  </div>
                </div>
                
                <div class="statistics col-lg-3">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-orange"><i class="fa fa-building"></i></div>
                    <div class="text"><strong>{{ $buildings_count }}</strong><br><small>Buildings</small></div>
                  </div>
                </div>

                <div class="statistics col-lg-3">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-orange"><i class="fa fa-question"></i></div>
                    <div class="text"><strong>{{ $questions_count }}</strong><br><small>Questions</small></div>
                  </div>
                </div>

                <div class="statistics col-lg-3">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-reply-all"></i></div>
                    <div class="text"><strong>0</strong><br><small>Responses</small></div>
                  </div>
                </div>

            
         </div>
    </div>
</section>

@endsection