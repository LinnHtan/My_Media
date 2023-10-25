@extends('admin.layouts.app')

@section('contend')
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('admin#createPost') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Title</label>
                  <input type="text" name="postTitle" value="{{ old('postTitle') }}" class="form-control" id="exampleInputEmail1" placeholder="Enter your category name..." aria-describedby="emailHelp">
                  @error('postTitle')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Description</label>
                 <textarea  type="text" name="postDescription" value=""  class="form-control" placeholder="Enter Your Description..." >{{ old('postDescription') }}</textarea>
                 @error('postDescription')
                 <div class="text-danger">{{ $message }}</div>
                 @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Image</label>
                    <input type="file" name="postImage" value="{{ old('postImage') }}" class="form-control" id="exampleInputEmail1" placeholder="Enter your category name..." aria-describedby="emailHelp">
                    @error('postImage')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                    <select name="postCategory" value="{{ old('postCategory') }}" class="form-control" id="">
                            <option value="" >Choose option...</option>
                            @foreach ($category as $c)
                            <option value="{{ $c['category_id'] }}">{{ $c->title }}</option>
                            @endforeach
                    </select>
                    @error('postCategory')
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
        <h3 class="card-title">Post List</h3>

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
              <th>Post ID</th>
              <th>Category Name</th>
              <th>Description </th>
              <th>Image </th>
              <th></th>
            </tr>
          </thead>
          <tbody>
                 @foreach ($post as $p)
                 <tr>
                <td>{{ $p['id'] }}</td>
                <td>{{ $p['title'] }}</td>
                <td >{{ $p['description'] }}</td>
                <td > <img width="100px" class="rounded shadow-sm"
                     @if($p['image'] == null)
                    src="{{ asset('defaultImage/default.jpg') }}"
                    @else
                    src="{{ asset('postImage/' .$p['image']) }}"
                    @endif  alt=""> </td>

                <td>
                 <a href="{{ route('admin#postUpdatePage',$p['id']) }}"> <button class="text-white btn btn-sm bg-dark"><i class="fas fa-edit"></i></button></a>
                  <a href="{{ route('admin#deletePost',$p['id']) }}"><button class="text-white btn btn-sm bg-danger"><i class="fas fa-trash-alt"></i></button></a>
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


