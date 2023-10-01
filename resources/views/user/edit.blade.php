@extends('backend.layouts.master')
@section('title', 'Edit User')
@section('content')

    <div class="row my-4">
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Edit User</h6>
                        </div>
                    </div>
                </div>

                <div class="card-body mx-12 pb-4">
                    <div>
                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                            @method('PUT')
                            @csrf
                            <label>Name</label>
                            <div class="mb-3">
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" placeholder="Enter name" value="{{ $user->name }}">
                            </div>
                            @error('name')
                                <p id="filled_error_help" class="mt-2 text-xs text-red">{{ $message }}</p>
                            @enderror

                            <label>Email</label>
                            <div class="mb-3">
                                <input type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Enter email" value="{{ $user->email }}">
                            </div>
                            @error('email')
                                <p id="filled_error_help" class="mt-2 text-xs text-red">{{ $message }}</p>
                            @enderror

                            <label>Password</label>
                            <div class="mb-3">
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" placeholder="Enter password" value="{{ $user->visible_password }}">
                            </div>
                            @error('password')
                                <p id="filled_error_help" class="mt-2 text-xs text-red">{{ $message }}</p>
                            @enderror

                            <label>Occupation</label>
                            <div class="mb-3">
                                <input type="text"
                                    class="form-control @error('occupation') is-invalid @enderror"
                                    name="occupation" placeholder="Enter occupation" value="{{ $user->occupation }}">
                            </div>
                            @error('occupation')
                                <p id="filled_error_help" class="mt-2 text-xs text-red">{{ $message }}</p>
                            @enderror

                            <label>Address</label>
                            <div class="mb-3">
                                <input type="text"
                                    class="form-control @error('address') is-invalid @enderror"
                                    name="address" placeholder="Enter address" value="{{ $user->address }}">
                            </div>
                            @error('address')
                                <p id="filled_error_help" class="mt-2 text-xs text-red">{{ $message }}</p>
                            @enderror

                            <label>Phone</label>
                            <div class="mb-3">
                                <input type="text"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" placeholder="Enter phone" value="{{ $user->phone }}">
                            </div>
                            @error('phone')
                                <p id="filled_error_help" class="mt-2 text-xs text-red">{{ $message }}</p>
                            @enderror
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-info w-25 mt-4 mb-0">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
