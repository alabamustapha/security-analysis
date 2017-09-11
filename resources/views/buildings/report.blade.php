@extends("layouts.admin")

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/summernote.css') }}">
@endsection

@section("content")
  
  <section>
  <div class="container-fluid">
    <div class="row">
        
        <div class="col-lg-12">
          <div class="card">
            
            <div class="card-header d-flex align-items-center">
              <h3 class="h4">Manage {{ $building->name }} Report</h3>
            </div>
            <div class="card-body">
              
               <div class="row">

                  <div class="col-md-12">
                    <form action="{{ route('create_building_report', ["building" => $building->name]) }}" method="post">
                    {{ csrf_field() }}
                      <div class="form-group">
                        <textarea name="body" id="report-editor" required autofocus>{{ $building->report->body or ''}}</textarea>
                            @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                      </div>

                        <div class="form-group">
                            
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                                
                      </form>
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
<script src="{{ asset('js/summernote.min.js') }}"></script>


<script type="text/javascript">
  
  $(document).ready(function() {
  
  $('textarea#report-editor').summernote({
      height: 300,                 // set editor height
      focus: true,                 // set focus to editable area after initializing
      hint: {       
        words: {!! json_encode($building->questionsCodes()) !!},
        match: /\b(\w{1,})$/,
        search: function (keyword, callback) {
          callback($.grep(this.words, function (item) {
            return item.indexOf(keyword) === 0;
          }));
        }
      }
  });

});

</script>

@endsection