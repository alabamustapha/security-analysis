@extends("layouts.admin")

@section("content")

 <section class="dashboard-header">
    <div class="container-fluid">          
          <div class="row">
                
                <div class="statistics col-lg-3">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
                    <div class="text"><strong>147</strong><br><small>Officers</small></div>
                  </div>
                </div>
                
                <div class="statistics col-lg-3">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
                    <div class="text"><strong>147</strong><br><small>Buildings</small></div>
                  </div>
                </div>

                <div class="statistics col-lg-3">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-orange"><i class="fa fa-tasks"></i></div>
                    <div class="text"><strong>234</strong><br><small>Questions</small></div>
                  </div>
                </div>

                <div class="statistics col-lg-3">
                  <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-tasks"></i></div>
                    <div class="text"><strong>234</strong><br><small>Responses</small></div>
                  </div>
                </div>

            
         </div>
    </div>
</section>

@endsection