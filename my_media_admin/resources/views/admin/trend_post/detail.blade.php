@extends('admin.layouts.app')

@section('contend')
<div class="col-6 offset-3 mt-5">
    <div class="card-header">
        <img width="300px" class="rounded shadow-sm"
        @if($details['image'] == null)
       src="{{ asset('defaultImage/default.jpg') }}"
       @else
       src="{{ asset('postImage/' .$details['image']) }}"
       @endif  alt="">
    </div>
    <div class="card-body">
        <h3>{{ $details['title'] }}</h3>
        <p>{{ $details['description'] }}</p>
    </div>
    <i class="fa-solid fa-arrow-left fs-3 text-dark" onclick="history.back()"></i>
    <!-- /.card -->
  </div>
@endsection


