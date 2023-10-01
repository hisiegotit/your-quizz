@extends('layouts.app')

@section('content')
<quiz-component
    :quizID="{{$quiz->id}}"
    :quiz-questions="{{$quizQuestions}}"
    :times="{{$quiz->minutes}}"
    :has-completed-quiz="{{$hasCompletedQuiz}}"
>

</quiz-component>
<script type="text/javascript">
    window.oncontextmenu = function() {
        return false;
    }
</script>
@endsection
