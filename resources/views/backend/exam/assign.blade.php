@extends('backend.layouts.master')
@section('title', 'Assign Quiz')
@section('content')
    <div class="row my-4">
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Assign Quiz</h6>
                        </div>
                    </div>
                </div>

                <div class="card-body mx-12 pb-4">
                    <div class="table">
                        
                        <form method="POST" action="{{ route('exam.assign') }}">
                            @csrf
                            {{-- Quiz --}}
                            <label>Quiz</label>
                            <select class="form-control" name="quiz_id" required>
                                <option>Choose Quiz</option>
                                @foreach (App\Models\Quiz::all() as $quiz)
                                    <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                @endforeach
                            </select>
                            {{-- User --}}
                            <label>User</label>
                            <select class="form-control" name="user_id" required>
                                <option>Choose User</option>
                                @foreach (App\Models\User::where('is_admin', 0)->get() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-info w-25 mt-4 mb-0">Assign</button>
                                
                                
                            </div>
                        </form>
                    </div>
                    <div class="table">
                        <div class="mt-4 text-center text-bold">Or</div>
                        <form action="{{route('exam.assignAll')}}" method="POST">
                            @csrf

                            <label>Quiz</label>
                            <select class="form-control" name="quiz_id" required>
                                <option>Choose Quiz</option>
                                @foreach (App\Models\Quiz::all() as $quiz)
                                    <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-primary w-25 mt-4 mb-0">Assign All</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
