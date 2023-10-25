@extends('admin.layouts.app')


@section('contend')
    <div class="mt-5 col-10 offset-2">
        <div class="col-md-9">
            <div class="card">
                <div class="p-2 card-header">
                    <legend class="text-center">Change Password Page</legend>
                    {{-- alert start --}}
                    @if (Session::has('lengthError'))
                    <div class="alert alert-success alert-dismissible fade show col-6 float-end" role="alert">
                        {{ Session::get('lengthError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    @if (Session::has('fail'))
                    <div class="alert alert-danger alert-dismissible fade show col-6 float-end" role="alert">
                        {{ Session::get('fail') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    {{-- alert end --}}
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form class="form-horizontal" method="post" action="{{ route('admin#changePassword') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="oldPassword" class="form-control" id="inputName"
                                            placeholder="Enter your old password..." >
                                            @error('oldPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="newPassword" class="form-control" id="inputEmail"
                                            placeholder="Enter your new password..." >
                                            @error('newPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="confirmPassword" class="form-control" id="inputEmail"
                                            placeholder="Enter your confirm password..." >
                                            @error('confirmPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="text-white btn bg-dark">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
