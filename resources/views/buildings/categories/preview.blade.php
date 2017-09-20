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
                          <label class="control-label">{{ $question->body . '(QUEST_' . $question->id . ')' }}</label>
                          @if($question->type == "text")
                           <textarea class="form-control"></textarea>
                          @elseif($question->type == "location")
                           <button class="btn btn-primary">Get location</button>
                           @elseif($question->type == "date")
                           <input type="date" name="" class="form-control">
                           @elseif($question->type == "dropdown")
                           <select class="form-control">
                              <option></option>
                              @foreach($question->options as $option)
                                
                                  <option value="{{ $option }}">{{ $option }}</option>
                              @endforeach
                           </select>
                           @elseif($question->type == "radio")
                           <br>
                              @foreach($question->options as $option)
                                
                                  <input type="radio" name="radio{{$question->id}}" value="{{ $option }}">&nbsp;{{ $option }}
                              @endforeach
                          @elseif($question->type == "checkbox")
                           <br>
                              @foreach($question->options as $option)
                                
                                  <input type="checkbox" name="checkbox{{$question->id}}" value="{{ $option }}">&nbsp;{{ $option }}
                                
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