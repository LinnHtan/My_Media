@extends('admin.layouts.app')

@section('contend')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post List</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="float-right form-control" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="p-0 card-body table-responsive">
        <table class="table text-center table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Post Title</th>
              <th>Image</th>
              <th>View Count</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($postLog as $l)
            <tr>
                <td>{{ $l['id'] }}</td>
                <td>{{ $l['title'] }}</td>
                <td > <img width="100px" class="rounded shadow-sm"
                    @if($l['image'] == null)
                   src="{{ asset('defaultImage/default.jpg') }}"
                   @else
                   src="{{ asset('postImage/' .$l['image']) }}"
                   @endif  alt=""> </td>
                <td><i class="fa-solid fa-eye me-2"></i>{{ $l['post_count'] }}</td>
                <td>
                  <a href="{{ route("admin#trendPostDetails",$l['id']) }}"><button class="text-white btn btn-sm bg-dark"><i class="fa-solid fa-circle-info"></i></button></a>

                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
       {{-- <div class="d-flex justify-content-end">
        {{ $postLog->links() }}
       </div> --}}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection


