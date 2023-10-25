@extends('admin.layouts.app')


@section('contend')
    <div class="mt-5 col-8 offset-3">
        <div class="col-md-9">
            <div class="card">
                <div class="p-2 card-header">
                    <legend class="text-center">User Profile</legend>
                    {{-- alert start --}}
                    @if (Session::has('updateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show col-6 float-end" role="alert">
                        {{ Session::get('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    {{-- alert end --}}
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form class="form-horizontal" method="post" action="{{ route('admin#update') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputName"
                                            placeholder="Enter your name..." value="{{ old('name', $user->name) }}">
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="inputEmail"
                                            placeholder="Enter your email..." value="{{ old('email', $user->email) }}">
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail"  class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="phone" class="form-control" id="inputEmail"
                                            placeholder="Enter your phone..." value="{{ old('phone', $user->phone) }}" >
                                            @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select name="gender" id="" class="form-control">
                                        @if ($user->gender == 'male')
                                            <option value="empty">Choose Your Option</option>
                                            <option value="male" selected >Male</option>
                                            <option value="female">Female</option>
                                        @elseif($user->gender == 'female')
                                            <option value="empty">Choose Your Option</option>
                                            <option value="male">Male</option>
                                            <option value="female" selected >Female</option>
                                        @else
                                            <option value="empty" selected >Choose Your Option</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        @endif
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="address" type="text" class="form-control" cols="30" rows="10" placeholder="Enter your address..." >{{ $user->address }}</textarea>
                                        @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="text-white btn bg-dark">Update</button>
                                    </div>
                                </div>
                            </form>

                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <a href="{{ route('admin#changePasswordPage') }}">Change Password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
