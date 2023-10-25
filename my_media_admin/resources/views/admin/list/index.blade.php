@extends('admin.layouts.app')

@section('contend')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List</h3>

        <div class="card-tools">
          <form action="{{ route('admin#listSearch') }}" method="post">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="adminSearchKey" value="{{ old('adminSearchKey') }}" class="float-right form-control" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
          </form>
        </div>
      </div>
      @if (Session::has('accountDeleteSuccess'))
      <div class="alert alert-success alert-dismissible fade show col-6 float-end" role="alert">
          {{ Session::get('accountDeleteSuccess') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <!-- /.card-header -->
      <div class="p-0 card-body table-responsive">
        <table class="table text-center table-hover text-nowrap">
          <thead>
            <tr>
              <th>User ID</th>
              <th> Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Gender</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody>
                @foreach ($userData as $item)
                <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['email'] }}</td>
                <td>{{ $item['phone'] }}</td>
                <td>{{ $item['address'] }}</td>
                <td>{{ $item['gender'] }}</td>
                <td>
                  {{-- <button class="text-white btn btn-sm bg-dark"><i class="fas fa-edit"></i></button> --}}
                 @if(auth()->user()->id != $item['id'])
                  <a href="{{ route('admin#deleteAccount', $item['id']) }}">
                  <button class="text-white btn btn-sm bg-danger"><i class="fas fa-trash-alt"></i></button>
                </a>
                 @else
                <a href="#"></a>
                @endif

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


