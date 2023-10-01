@extends('backend.layouts.master')
@section('title', 'Show Question')
@section('content')
@foreach ($quizzes as $quiz)

<div class="card mb-2">
    <div class="card-body pt-2 pb-2">
      <p class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">{{$quiz->name}}</p>
      @foreach ($quiz->questions as $question)
      <a href="{{route('question.show', $question->id)}}" class="card-title h5 d-block text-darker">
        {{$question->question}}
      </a>
      <ul class="list-group mb-4">
        @foreach ($question->answers as $answer)
            <li class="list-group-item @if($answer->is_correct == 1) active @endif">{{$answer->answer}}</li>
        @endforeach
    </ul>
<hr class="bg-black">
    @endforeach
    </div>
</div>
  @endforeach
@endsection
