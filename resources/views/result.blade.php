@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="bg-white mb-2 px-4">
            <div class="card-body pt-2 pb-2">
                <p class="text-gradient text-primary text-uppercase text-xl font-weight-bold my-2 text-center"><strong>Your
                        Result</strong></p>
                @foreach ($results as $key => $result)
                    <a href="" class="card-title h5 d-block text-darker">
                        {{ $key + 1 }}. {{ $result->question->question }}
                    </a>
                    @php
                        $answers = App\Models\Answer::where('question_id', $result->question_id)->get();
                        $correct = App\Models\Answer::where('question_id', $result->question_id)
                            ->where('is_correct', 1)
                            ->get();
                    @endphp
                    <ul class="list-group mb-4">
                        @foreach ($answers as $answer)
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center
                                    @if ($answer->answer == $result->answer->answer) active @endif
                                ">

                                {{ $answer->answer }}
                                @if ($answer->answer == $result->answer->answer && $answer->is_correct == 1)
                                    <span class="badge bg-gradient-success">Correct</span>
                                @elseif($answer->answer == $result->answer->answer && $result->answer->is_correct == 0)
                                    <span class="badge bg-gradient-danger">Incorrect</span>
                                @elseif($answer->is_correct == 1)
                                    <span class="badge bg-gradient-success">Correct</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <hr class="bg-black">
                @endforeach
            </div>
        </div>
    </div>
@endsection
