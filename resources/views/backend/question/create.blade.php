@extends('backend.layouts.master')
@section('title', 'Create Question')
@section('content')
    <div class="row my-4">
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Create Question</h6>
                        </div>
                    </div>
                </div>

                <div class="card-body mx-12 pb-4">
                    <div class="table">
                        @if (Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('question.store') }}">
                            @csrf
                            {{-- Quiz --}}
                            <label>Quiz</label>
                            <select class="form-control" name="quiz_id">
                                <option>Choose Quiz</option>
                                @foreach (App\Models\Quiz::all() as $quiz)
                                    <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                @endforeach
                            </select>
                            {{-- Question --}}
                            <label>Question</label>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="question" placeholder="Enter question"
                                    value="{{ old('question') }}"
                                @error('question')
                                    is-invalid
                                @enderror>
                            </div>
                            @error('question')
                                <p id="filled_error_help" class="mt-2 text-xs text-red">{{ $message }}</p>
                            @enderror
                            {{-- Options --}}
                            <label>Options</label>
                            <div class="mb-3">
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="options[]"
                                                    placeholder="Options {{ $i + 1 }}"
                                                    @error('options')
                                                        is-invalid
                                                    @enderror>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="correct_answer"
                                                        id="correct_answer" value="{{$i}}" required>
                                                    <label class="custom-control-label" for="correct_answer">Correct Answer</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor

                            </div>
                            @error('options')
                                <p id="filled_error_help" class="mt-2 text-xs text-red">{{ $message }}</p>
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
