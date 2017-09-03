@extends("layouts.admin")

@section("content")
  
  <section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
              <div class="card">
                
                <div class="card-header d-flex align-items-center">
                  <h3 class="h4">Manage {{ $building->name }} {{ $category->name }} questions</h3>
                </div>

                <div class="card-body">
                  @if(count($errors) > 0)
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                  <div class="question-group">
                      <form action="{{ url('questions') }}" method="post">
                      <input type="hidden" name="building_id" value="{{ $building->id }}" required>
                      <input type="hidden" name="category_id" value="{{ $category->id }}" required>
                            
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="body" class="control-label">Question</label>
                                <textarea name="body" class="form-control" id="body" required autofocus>{{ old('body') }}</textarea>

                                  
                                  @if ($errors->has('body'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('body') }}</strong>
                                      </span>
                                  @endif
                                  
                            </div>

                            <div class="form-group">
                                <label for="type">Answer Type</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option></option>
                                    <optgroup label="General">
                                      <option value="text">Text</option>
                                      <option value="date">Date</option>
                                      <option value="location">Location</option>
                                    </optgroup>

                                    <optgroup label="Others">
                                      <option value="checkbox">Check Box</option>
                                      <option value="rating">Rating</option>
                                      <option value="dropdown">Drop down</option>
                                      <option value="radio">Radio Button</option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="form-group" id="options">
                                <label for="options" class="control-label">Options</label>

                                <div class="row mt10" id="option-type-date">
                                    <div class="col-md-6">
                                      <input type="date" name="from_date" class="form-control option-value" placeholder="minimum date">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="date" name="to_date" class="form-control option-value" placeholder="maximum date">
                                    </div>
                                </div>
                            

                                <div class="row mt10" id="option-type-range">
                                    <div class="col-md-6">
                                      <input type="date" name="min" class="form-control" placeholder="minimum value">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="date" name="max" class="form-control" placeholder="maximum value">
                                    </div>
                                </div>

                                <div class="row mt10" id="option-type-multiple">
                                    <div class="col-md-6">
                                      <input type="number" name="value" class="form-control option-value" placeholder="value">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" name="label" class="form-control option-label" placeholder="label">
                                    </div>
                                </div>
                                  
                            </div>



                            <div class="form-group">
                                
                                <button type="submit" class="btn btn-primary" id="add-question">
                                    Save and New
                                </button>

                                <button id="add-more" class="btn btn-primary">Add more options</button>
                            </div>
                      </form>
                  </div>

                </div>
              </div>
            </div>
        </div>
    </div>
  </section>

@endsection

@section('scripts')

<script type="text/javascript">
  $(document).ready(function(){
    $('#options, #option-type-date, #option-type-multiple, #option-type-range, #add-more').hide();

    $('#type').change(function(){
      var type = $(this).val();

      if(type == "text" || type == "location"){
          $('#options, #option-type-date, #option-type-multiple, #option-type-range, #add-more').hide();
      }else if(type == "date"){
          $('#options, #option-type-date').show();
          $('#option-type-multiple, #option-type-range', '#add-more').hide();
      }else if(type == "rating"){
          $('#options, #option-type-date, #option-type-multiple, #add-more').hide();
          $('#options, #option-type-range').show();
          
      }else if(type == "checkbox" || type == "radio" || type=="dropdown"){
          $('#options, #option-type-date, #option-type-range').hide();
          $('#options, #option-type-multiple, #add-more').show();
          

          $("button#add-more").click(function(event){

              event.preventDefault();
              
              var len = $("#option-type-multiple").children().length;
              
              $("#option-type-multiple").append(
                      '<div class="col-md-6 mt10">' +
                            '<input type="number" name="value_'  + len/2 + '" class="form-control option-value" placeholder="value">' +
                        '</div>' +
                        '<div class="col-md-6 mt10">' +
                              '<input type="text" name="label_'  + len/2 + '"  class="form-control option-label" placeholder="label">' +
                          '</div>'

              )
          });

      }

    });

  });
</script>

@endsection