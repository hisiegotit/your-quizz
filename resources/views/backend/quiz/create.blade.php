@extends('backend.layouts.master')

@section('title', 'Create Quiz')
@section('content')

<div class="row my-4">
    <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Create Quiz</h6>
            </div>
          </div>
        </div>

        <div class="card-body mx-12 pb-4">
          <div class="table-responsive">
            @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get('message')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form method="POST" action="{{route('quiz.store')}}">
                @csrf
                <label>Quiz name</label>
                <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Enter quiz's name" value="{{old('name')}}"
                @error('name')
                    is-invalid
                @enderror>
                </div>
                    @error('name')
                        <p id="filled_error_help" class="mt-2 text-xs text-red">{{$message}}</p>
                    @enderror
                <label>Quiz description</label>
                <div class="mb-3">
                  <textarea class="form-control" name="description" placeholder="Enter description"
                  @error('description')
                    is-invalid
                  @enderror></textarea>
                </div>
                    @error('description')
                    <p id="filled_error_help" class="mt-2 text-xs text-red">{{$message}}</p>
                    @enderror
                <label>Quiz time</label>
                <div class="mb-3">
                  <input type="text" class="form-control" name="minutes" placeholder="Enter time (minutes)"
                  @error('minutes')
                    is-invalid
                  @enderror
                  >
                </div>
                    @error('minutes')
                        <p id="filled_error_help" class="mt-2 text-xs text-red">{{$message}}</p>
                    @enderror
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-info w-50 mt-4 mb-0">Create</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>




@endsection
