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
              <button class="btn btn-danger pull-right"><i class="fa fa-trash"></i></button>&nbsp;
              <h3 class="h4">Manage {{ $building->name }} Report - Page {{ $report->page }}</h3>

            </div>
            <div class="card-body">
              
               <div class="row">

                  <div class="col-md-12">
                    <form action="{{ route('create_building_report', ["building" => $building->name, "id" => $report->id]) }}" method="post">
                    {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label for="page" class="label-contol">Page Number</label>
                              <input class="form-control" type="number" id="page" name="page" value="{{ $report->page }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                              <label for="goto-page" class="label-contol"> Goto</label>
                              <select name="goto_page" id="goto-page" class="form-control">
                                  <option></option>
                                  @foreach($building->reports as $building_report)
                                    <option value="{{ $building_report->page }}">{{ "Page " . $building_report->page }}</option>
                                  @endforeach
                              </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="page-title" class="label-contol">Page title</label>
                        <input class="form-control" type="text" id="page-title" name="title" value="{{ $report->title or "" }}">
                      </div>
                      <div class="form-group">
                        <textarea name="body" id="report-editor" autofocus>{{ $report->body }}</textarea>
                            @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                      </div>


                        <div class="form-group">
                            
                            <input type="submit" class="btn btn-primary" name="save" value="Save">
                            <input type="submit" class="btn btn-primary" name="save_and_new" value="Save and New Page">
                            <input type="submit" class="btn btn-primary" name="save_and_goto" value="Save and Goto Page">
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