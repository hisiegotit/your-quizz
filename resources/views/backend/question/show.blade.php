@extends('backend.layouts.master')
@section('title', 'Show Question')
@section('content')
<div class="card">
    <div class="card-body pt-2 pb-2">
        <div class="navigation d-flex justify-content-between">
            @if ($previousItem)
                <a class="mt-4" href="{{ route('question.show', $previousItem->id) }}">
                    <span class="badge badge-pill bg-gradient-primary">Previous</span></a>
            @endif

            @if ($nextItem)
                <a class="mt-4" href="{{ route('question.show', $nextItem->id) }}">
                    <span class="badge badge-pill bg-gradient-primary">Next</span></a>
            @endif
        </div>
      <p class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">{{$question->quiz->name}}</p>
      <a href="javascript:;" class="card-title h5 d-block text-darker">
        {{$question->question}}
      </a>
      <ul class="list-group mb-4">
        @foreach ($question->answers as $answer)
            <li class="list-group-item @if($answer->is_correct == 1) active @endif">{{$answer->answer}}</li>
        @endforeach
      </ul>
      <a href="{{route('question.edit', $question->id)}}" class="btn btn-warning">Edit</a>
      <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#{{$question->id}}Modal">Delete</button>
    </div>
</div>
  <form action="{{route('question.destroy', $question->id)}}" method="POST">
    @method('DELETE')
    @csrf
    <div class="modal fade" id="{{$question->id}}Modal" tabindex="-1" aria-labelledby="{{$question->id}}ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 text-center" id="{{$question->id}}ModalLabel"><i class="fas fa-exclamation-triangle"></i> Confirm</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-bold text-center fs-3">
              Do you want to delete this question?<br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
  </form>
@endsection
