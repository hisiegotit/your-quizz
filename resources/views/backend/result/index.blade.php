@extends('backend.layouts.master')

@section('title', 'User result')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-start mb-3">
                    <h6 class="p-2">User Result</h6>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quiz</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    {{-- <th class="text-secondary opacity-7"></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quizzes as $key => $quiz)
                                    @foreach ($quiz->users as $key => $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <h6 class="mb-0 text-sm">{{ $key + 1 }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="{{ route('quiz.show', $user->id) }}">
                                                        <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ route('quiz.show', $quiz->id) }}">
                                                    <h6 class="mb-0 text-sm">{{ $quiz->name }}</h6>
                                                </a>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if (App\Models\Result::where('quiz_id', $quiz->id)->where('user_id', $user->id)->exists())
                                                    <span class="badge bg-gradient-success">Completed</span>
                                                @else
                                                    <span class="badge bg-gradient-dark">Not Completed</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('quiz.show', $quiz->id) }}"
                                                    class="text-dark font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit">
                                                    View question
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('quiz.show', $quiz->id) }}"
                                                    class="text-info font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit">
                                                    View Result
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{$quizzes->links('pagination::bootstrap-5')}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
