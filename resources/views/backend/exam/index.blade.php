@extends('backend.layouts.master')

@section('title', 'Exam')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-start mb-3">
                    <h6 class="p-2">User Exam</h6>
                    <a href="{{ route('quiz.create') }}" class="btn btn-primary ms-2">Create Quizz</a>
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
                                                <a href="
                                                        @if (App\Models\Result::where('quiz_id', $quiz->id)->where('user_id', $user->id)->exists())
                                                            {{ route('result.view', [$quiz->id, $user->id]) }}
                                                        @else
                                                            javascript:;
                                                        @endif
                                                        "
                                                    class="
                                                        @if (App\Models\Result::where('quiz_id', $quiz->id)->where('user_id', $user->id)->exists())
                                                            text-dark
                                                        @else
                                                            text-secondary
                                                        @endif
                                                    font-weight-bold text-xs bg-white border-0"
                                                    @if (App\Models\Result::where('quiz_id', $quiz->id)->where('user_id', $user->id)->exists())
                                                    @else
                                                        disabled
                                                    @endif
                                                    data-toggle="tooltip" data-original-title="Edit" role="button">
                                                    View Result
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                            <button href="javascript:;" data-bs-toggle="modal" data-bs-target="#{{$user->id}}Modal" class="border-0 bg-white text-secondary font-weight-bold text-xs text-danger" data-toggle="tooltip" data-original-title="Delete">
                                                Delete
                                            </button>
                                            </td>
                                        </tr>
                                        <form action="{{route('exam.destroy')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                                            <div class="modal fade" id="{{$user->id}}Modal" tabindex="-1" aria-labelledby="{{$user->id}}ModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5 text-center" id="{{$user->id}}ModalLabel"><i class="fas fa-exclamation-triangle"></i>Confirm</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-bold text-center fs-3">
                                                      Do you want to unassign this exam?<br>
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
                                @endforeach
                            </tbody>
                        </table>
                        {{$quizzes->links('pagination::bootstrap-5')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
