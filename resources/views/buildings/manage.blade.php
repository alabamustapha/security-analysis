@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-9">
                  <div class="card">
                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Manage {{ $building->name }}</h3>
                    </div>
                    <div class="card-body">
                    
                    
                      <a class="btn btn-primary" href="{{ url('/categories/create') }}" href="_blank">
                        Add new category
                      </a>
                      <hr>
                       
                      <span>Total questions: {{ $building->questions()->count() }}</span> 

                    <table class="table table-bordered">
                      <thead>
                          <th>Category</th>
                          <th>No of questions</th>
                          <th>Sub categories</th>
                      </thead>
                      <tbody>
                        @foreach($categories as $category)
                          <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $building->categoryQuestions($category->id)->count() }}</td>
                            <td>

                              @foreach($category->sub_categories->pluck('name') as $sub_name)
                                  @if ($loop->last)
                                        {{ $sub_name }}
                                  @else
                                        {{ $sub_name . ' , ' }}
                                  @endif
                              @endforeach

                            </td>
                            <td>
                              <a href="{{ url('buildings/' . $building->id . '/categories/' . $category->id . '/questions' ) }}" class="btn btn-primary"> Questions</a>
                              <a href="{{ url('buildings/' . $building->id . '/categories/' . $category->id . '/preview' ) }}" class="btn btn-primary"> Preview</a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                      

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