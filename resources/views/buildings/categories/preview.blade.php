@extends("layouts.admin")

@section("content")
  
  <section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card">
                
                <div class="card-header d-flex align-items-center">
                  <h3 class="h4">Preview {{ $building->name }} {{ $category->name }} questions</h3>
                </div>

                <div class="card-body">
                  <form>
                  @foreach($category_questions as $question)
                      <div class="form-group">
                          <label class="control-label">{{ $question->body }}</label>
                          @if($question->type == "text")
                           <textarea class="form-control"></textarea>
                          @elseif($question->type == "location")
                           <button class="btn btn-primary">Get location</button>
                           @elseif($question->type == "date")
                           <input type="date" name="" class="form-control">
                           @elseif($question->type == "dropdown")
                           <select class="form-control">
                              <option></option>
                              @foreach(prepareQuestionOptions($question->options) as $option)
                                @if(str_contains($option, '|'))
                                  <option value="{{ getQuestionOptionValue($option) }}">{{ getQuestionOptionLabel($option) }}</option>
                                @endif
                              @endforeach
                           </select>
                           @elseif($question->type == "radio")
                           <br>
                              @foreach(prepareQuestionOptions($question->options) as $option)
                                @if(str_contains($option, '|'))
                                  <input type="radio" name="radio{{$question->id}}" value="{{ getQuestionOptionValue($option) }}">&nbsp;{{ getQuestionOptionLabel($option) }}
                                @endif
                              @endforeach
                          @elseif($question->type == "checkbox")
                           <br>
                              @foreach(prepareQuestionOptions($question->options) as $option)
                                @if(str_contains($option, '|'))
                                  <input type="checkbox" name="checkbox{{$question->id}}" value="{{ getQuestionOptionValue($option) }}">&nbsp;{{ getQuestionOptionLabel($option) }}
                                @endif
                              @endforeach
                          @endif
                        </div>
                  @endforeach
                  </form>
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
    
  });
</script>

@endsection