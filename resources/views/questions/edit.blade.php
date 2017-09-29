@extends("layouts.admin")

@section("content")
  
  <section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
              <div class="card">
                
                <div class="card-header d-flex align-items-center">
                  <h3 class="h4">Edit {{ $question->building->name }}  question (QUEST_{{ $question->id}})</h3>
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
                      <form action="{{ route('update_question', ['question' => $question->id]) }}" method="post">
                      <input type="hidden" name="building_id" value="{{ $question->building->id }}" required>
                      <input type="hidden" name="category_id" value="{{ $question->category->id }}" required>
                            
                            {{ csrf_field() }}
                            {{ method_field("PUT") }}

                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="body" class="control-label">Question</label>
                                <textarea name="body" class="form-control" id="body" required autofocus>{{ $question->body }}</textarea>

                                  
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
                                      <option value="text" {{ $question->type == 'text' ?  'selected' : ''}}>Text</option>
                                      <option value="date" {{ $question->type == 'date' ?  'selected' : ''}}>Date</option>
                                      <option value="location" {{ $question->type == 'location' ?  'selected' : ''}}>Location</option>
                                    </optgroup>

                                    <optgroup label="Others">
                                      <option value="checkbox" {{ $question->type == 'checkbox' ?  'selected' : ''}}>Check Box</option>
                                      <option value="rating" {{ $question->type == 'rating' ?  'selected' : ''}}>Rating</option>
                                      <option value="dropdown" {{ $question->type == 'dropdown' ?  'selected' : ''}}>Drop down</option>
                                      <option value="radio" {{ $question->type == 'radio' ?  'selected' : ''}}>Radio Button</option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="form-group" id="options">
                                <label for="options" class="control-label">Options</label>

                                <div class="row mt10" id="option-type-date">
                                    <div class="col-md-6">
                                      <input type="date" name="from_date" class="form-control option-value" placeholder="minimum date" {{ $question->type == 'date' ? 'value=' . $question->options[0] : ''}}>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="date" name="to_date" class="form-control option-value" placeholder="maximum date" {{ $question->type == 'date' ? 'value=' . $question->options[1] : ''}}>
                                    </div>
                                </div>
                            

                                <div class="row mt10" id="option-type-range">
                                    <div class="col-md-6">
                                      <input type="date" name="min" class="form-control" placeholder="minimum value" {{ $question->type == 'rating' ? 'value=' . $question->min : ''}}>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="date" name="max" class="form-control" placeholder="maximum value" {{ $question->type == 'rating' ? 'value=' . $question->max : ''}}>
                                    </div>
                                </div>

                                <div class="row mt10" id="option-type-multiple">

                                @if(in_array($question->type, ['checkbox', 'radio', 'dropdown']))

                                  @foreach($question->options as $option)


                                      <div class="col-md-12 mt10">
                                          <input type="text" name="option_{{$loop->iteration}}" class="form-control option-label" placeholder="option" value="{{ $option }}">
                                      </div>
                                    
                                  @endforeach

                                @endif
                                    
                                </div>
                                  
                            </div>



                            <div class="form-group">
                                
                                <button type="submit" class="btn btn-primary" id="update-question">
                                    Update question
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

    var cur_type = $('#type').val();
    
    if(cur_type == "text" || cur_type == "location"){
          $('#options, #option-type-date, #option-type-multiple, #option-type-range, #add-more').hide();
      }else if(cur_type == "date"){
          $('#options, #option-type-date').show();
          $('#option-type-multiple, #option-type-range', '#add-more').hide();
      }else if(cur_type == "rating"){
          $('#options, #option-type-date, #option-type-multiple, #add-more').hide();
          $('#options, #option-type-range').show();
          
      }else if(cur_type == "checkbox" || cur_type == "radio" || cur_type=="dropdown"){
          $('#options, #option-type-date, #option-type-range').hide();
          $('#options, #option-type-multiple, #add-more').show();
          

          $("button#add-more").click(function(event){

              event.preventDefault();
              
              var len = $("#option-type-multiple").children().length + 1;
              
              $("#option-type-multiple").append(
                        '<div class="col-md-12 mt10">' +
                              '<input type="text" name="option_'  + len + '"  class="form-control option-label" placeholder="option">' +
                          '</div>'

              )
          });

      }



    $('#type').change(function(){
      var type = $(this).val();

      if(type == "text" || type == "location"){
          $('#options, #option-type-date, #option-type-multiple, #option-type-range, #add-more').hide();
      }else if(type == "date"){
            $('#options, #option-type-date, #option-type-multiple, #add-more').hide();
          $('#options, #option-type-date').show();
      }else if(type == "rating"){
          $('#options, #option-type-date, #option-type-multiple, #add-more').hide();
          $('#options, #option-type-range').show();
          
      }else if(type == "checkbox" || type == "radio" || type=="dropdown"){
          $('#options, #option-type-date, #option-type-range').hide();
          $('#options, #option-type-multiple, #add-more').show();
          

          $("button#add-more").click(function(event){

              event.preventDefault();
              
              var len = $("#option-type-multiple").children().length + 1;
              
              $("#option-type-multiple").append(
                        '<div class="col-md-12 mt10">' +
                              '<input type="text" name="option_'  + len + '"  class="form-control option-label" placeholder="option">' +
                          '</div>'

              )
          });

      }

    });

  });
</script>

@endsection