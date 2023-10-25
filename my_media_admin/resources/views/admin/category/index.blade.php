@extends('admin.layouts.app')

@section('contend')
<div class="col-4">
    <div class="card">
        @if (Session::has('createSuccess'))
        <div class="alert alert-success alert-dismissible fade show " role="alert">
            {{ Session::get('createSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="card-body">
            <form method="post" action="{{ route('admin#createCategory') }}">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Category Name</label>
                  <input type="text" name="categoryName" class="form-control" id="exampleInputEmail1" placeholder="Enter your category name..." aria-describedby="emailHelp">
                  @error('categoryName')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Description</label>
                 <textarea  type="text" name="descriptionName"  class="form-control" placeholder="Enter Your Description..." ></textarea>
                 @error('descriptionName')
                 <div class="text-danger">{{ $message }}</div>
                 @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
              </form>
        </div>
    </div>
</div>
<div class=" col-8">
    <div class="card">
        @if (Session::has('deleteSuccess'))
        <div class="alert alert-success alert-dismissible fade show offset-4" role="alert">
            {{ Session::get('deleteSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      <div class="card-header">
        <h3 class="card-title">Category List</h3>

        <div class="card-tools">
          <form action="{{ route('admin#categorySearch') }}" method="post">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="categorySearch" class="float-right form-control" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
          </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="p-0 card-body table-responsive">
        <table class="table text-center table-hover text-nowrap">
          <thead>
            <tr>
              <th>Category ID</th>
              <th>Category Name</th>
              <th>Description </th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
                 @foreach ($category as $c)
                 <tr>
                <td>{{ $c['category_id'] }}</td>
                <td>{{ $c['title'] }}</td>
                <td>{{ $c['description'] }}</td>
                <td>{{ $c['created_at'] }}</td>
                <td>{{ $c['updated_at'] }}</td>

                <td>
                 <a href="{{ route('admin#categoryEditPage',$c['category_id']) }}"> <button class="text-white btn btn-sm bg-dark"><i class="fas fa-edit"></i></button></a>
                  <a href="{{ route('admin#deleteCategory',$c['category_id']) }}"><button class="text-white btn btn-sm bg-danger"><i class="fas fa-trash-alt"></i></button></a>
                </td>
              </tr>
             @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection


