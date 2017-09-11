@extends("layouts.admin")

@section("content")
  
  <section>
  <div class="container-fluid">
              <div class="row">
                
                <div class="col-lg-12">
                  <div class="card">
                    
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Categories</h3>

                    </div>
                    <div class="card-body">
                      <a class="btn btn-primary" href="{{ url('categories/create') }}">Add New Category</a>
                      <hr>
                      <table class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Main Category</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($categories as $category) 
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->main_category->name or '' }}</td>
                            <td><button class="btn btn-danger delete-category" id="form{{ $category->id }}">Delete</button>

                            <form id="delete-category-form{{ $category->id }}" action="{{ route('delete_category', ['category' => $category->name]) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                            <a class="btn btn-primary" href="{{ route('edit_category', $category->name) }}">Edit</a></td>
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

@section('scripts')
    <script type="text/javascript">

      $(document).ready(function(){

          $('button.delete-category').click(function(event){
            
            event.preventDefault();

            var form = $(this).attr('id');
            swal({
              title: "Are you sure?",
              text: "Category, subcategories and all related questions will be deleted",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(){
              document.getElementById('delete-category-' + form).submit();
            });
      
          });
          
      });
      
      
    </script>
@endsection