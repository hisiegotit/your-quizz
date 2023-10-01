@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($isExamAssigned)
                    @foreach ($quizzes as $quiz)
                        <div class="card my-4">
                            <div class="card-body">
                                <p class="h3">{{ $quiz->name }}</p>
                                <p><strong>About Exam:</strong> {{ $quiz->description }}</p>
                                <p><strong>Time allocated:</strong> {{ $quiz->minutes }} minutes</p>
                                <p><strong>Number of questions:</strong> {{ $quiz->questions->count() }}</p>
                                <p>
                                    @if (!in_array($quiz->id, $wasCompleted))
                                        <a href="{{ route('exam.start', $quiz->id) }}" class="btn btn-primary mt-2">Start</a>
                                    @else
                                        <button href="" class="btn btn-success mt-2" disabled>Completed</button>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card-body">
                        <p>There is no exam assigned to you.</p>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card my-4">
                    <div class="card-body">
                        <p class="h4">Profile</p>
                        <p>Email: {{Auth::user()->email}}</p>
                        <p>Occupation: {{Auth::user()->occupation}}</p>
                        <p>Address: {{Auth::user()->address}}</p>
                        <p>Phone: {{Auth::user()->phone}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
