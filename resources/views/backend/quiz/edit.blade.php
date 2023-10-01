@extends('backend.layouts.master')

@section('title', 'Edit Quiz')
@section('content')

<div class="row my-4">
    <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Edit Quiz</h6>
            </div>
          </div>
        </div>

        <div class="card-body mx-12 pb-4">
          <div class="table-responsive">
            <form method="POST" action="{{route('quiz.update', $quiz->id)}}">
                @method('PUT')
                @csrf
                <label>Quiz name</label>
                <div class="mb-3">
                <input type="text" class="form-control @error('name')
                is-invalid
            @enderror" name="name" placeholder="Enter quiz's name" value="{{$quiz->name}}"
                >
                </div>
                    @error('name')
                        <p id="filled_error_help" class="mt-2 text-xs text-red">{{$message}}</p>
                    @enderror
                <label>Quiz description</label>
                <div class="mb-3">
                  <textarea class="form-control @error('description')
                  is-invalid
                @enderror" name="description" placeholder="Enter description"
                  >{{$quiz->description}}</textarea>
                </div>
                    @error('description')
                    <p id="filled_error_help" class="mt-2 text-xs text-red">{{$message}}</p>
                    @enderror
                <label>Quiz time</label>
                <div class="mb-3">
                  <input type="text" class="form-control @error('minutes')
                  is-invalid
                @enderror" name="minutes" value="{{$quiz->minutes}}" placeholder="Enter time (minutes)"
                  >

                </div>
                    @error('minutes')
                        <p id="filled_error_help" class="mt-2 text-xs text-red">{{$message}}</p>
                    @enderror
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-info w-50 mt-4 mb-0">Update</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>




@endsection
