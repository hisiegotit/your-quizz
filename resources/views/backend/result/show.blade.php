@extends('backend.layouts.master')
@section('content')
<div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">#</th>
            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Quiz</th>
            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Total Questions</th>
            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Attempt Questions</th>
            <th class="text-center text-uppercase text-xs font-weight-bolder opacity-7 text-success">Correct Answer</th>
            <th class="text-center text-uppercase text-xs font-weight-bolder opacity-7 text-danger">Incorrect Answer</th>
            <th class="text-center text-uppercase text-xs font-weight-bolder opacity-7
            @if($percentage < 50)
                            text-danger
                        @elseif ($percentage > 50 && $percentage < 75)
                            text-warning
                        @else
                            text-success
                        @endif
            ">Percentage</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($quizzes as $key => $quiz)
          <tr>
              <td>
                <div class="align-middle text-center">
                    <h6 class="mb-0 text-sm">{{$key+1}}</h6>
                </div>
              </td>
              <td class="align-middle text-center">
                    <h6 class="mb-0 text-sm">{{$quiz->name}}</h6>
              </td>
              <td class="align-middle text-center">
                    <h6 class="mb-0 text-sm">{{$totalQuestions}}</h6>
              </td>
              <td class="align-middle text-center">
                    <h6 class="mb-0 text-sm">{{$attemptQuestions}}</h6>
              </td>
              <td class="align-middle text-center">
                    <h6 class="mb-0 text-sm text-success">{{$userCorrect}}</h6>
              </td>
              <td class="align-middle text-center">
                    <h6 class="mb-0 text-sm text-danger">{{$userIncorrect}}</h6>
              </td>
              <td class="align-middle text-center">
                    <h6 class="mb-0 text-sm
                        @if($percentage < 50)
                            text-danger
                        @elseif ($percentage > 50 && $percentage < 75)
                            text-warning
                        @else
                            text-success
                        @endif
                    ">{{round($percentage)}}%</h6>
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>
      <div class="border my-4"></div>
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">#</th>
            <th class="text-start text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Question</th>
            <th class="text-start text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Answer Given</th>
            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Result</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($results as $key => $result)
          <tr>
              <td>
                <div class="align-middle text-center">
                    <h6 class="mb-0 text-sm">{{$key+1}}</h6>
                </div>
              </td>
              <td class="align-middle text-start">
                    <h6 class="mb-0 text-sm ms-3">{{$result->question->question}}</h6>
              </td>
              <td class="align-middle text-start">
                    <h6 class="mb-0 text-sm ms-3">{{$result->answer->answer}}</h6>
              </td>
              <td class="align-middle text-center">
                    <h6 class="mb-0 text-sm">
                        @if ($result->answer->is_correct == 1)
                            <span class="badge bg-gradient-success">Correct</span>
                        @else
                            <span class="badge bg-gradient-danger">Incorrect</span>
                        @endif
                    </h6>
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
