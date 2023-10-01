@extends('backend.layouts.master')
@section('title', 'User')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-start mb-3">
          <h6 class="p-2">All Users</h6>
          <a href="{{route('user.create')}}" class="btn btn-primary ms-2">Create User</a>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Occupation</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                  {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th> --}}
                  <th class="text-secondary opacity-7"></th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $key => $user)
                <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <h6 class="mb-0 text-sm">{{$key+1}}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <a href="{{route('user.show', $user->id)}}">
                                <h6 class="mb-0 text-sm">{{$user->name}}</h6>
                            </a>
                          </div>
                    </td>
                    <td class="align-middle text-sm">
                        {{$user->email}}
                    </td>
                    <td class="align-middle text-sm">
                        {{$user->occupation}}
                    </td>
                    <td class="align-middle text-sm">
                        {{$user->address}}
                    </td>
                    <td class="align-middle text-sm">
                        {{$user->phone}}
                    </td>
                    <td class="align-middle text-sm">
                        @if ($user->is_admin == 1)
                            <span class="badge badge-sm bg-gradient-primary">Admin</span>
                        @else
                            <span class="badge badge-sm bg-gradient-secondary">User</span>
                        @endif
                    </td>
                    {{-- <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{$user->created_at->format('d-M-Y')}}</span>
                    </td> --}}
                    <td class="align-middle">
                      <a href="{{route('user.edit', $user->id)}}" class="text-secondary font-weight-bold text-xs text-warning" data-toggle="tooltip" data-original-title="Edit">
                        Edit
                      </a>
                    </td>
                    <td class="align-middle">
                      <button href="javascript:;" data-bs-toggle="modal" data-bs-target="#{{$user->id}}Modal" class="border-0 bg-white text-secondary font-weight-bold text-xs text-danger" data-toggle="tooltip" data-original-title="Delete">
                        Delete
                      </button>
                    </td>
                  </tr>
                  <form action="{{route('user.destroy', $user->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal fade" id="{{$user->id}}Modal" tabindex="-1" aria-labelledby="{{$user->id}}ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5 text-center" id="{{$user->id}}ModalLabel"><i class="fas fa-exclamation-triangle"></i> Confirm</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-bold text-center fs-3">
                              Do you want to delete this user?<br>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </form>
                @endforeach
              </tbody>
            </table>
            {{$users->links('pagination::bootstrap-5')}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
