@extends('backend.layouts.master')
@section('title', 'Question')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0 d-flex justify-content-start mb-3">
          <h6 class="p-2">All Questions</h6>
          <a href="{{route('question.create')}}" class="btn btn-primary ms-2">Create Question</a>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Question</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Quiz</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                  <th class="text-secondary opacity-7"></th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($questions as $key => $question)
                <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <h6 class="mb-0 text-sm">{{$key+1}}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column justify-content-center">
                            <a href="{{route('question.show', $question->id)}}">
                                <h6 class="mb-0 text-sm">{{$question->question}}</h6>
                            </a>
                          </div>
                    </td>
                    <td class="align-middle text-sm">
                        <a href="{{route('quiz.show', $question->quiz->id)}}">
                            {{$question->quiz->name}}
                        </a>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{$question->created_at->format('d-M-Y')}}</span>
                    </td>
                    <td class="align-middle">
                      <a href="{{route('question.edit', $question->id)}}" class="text-secondary font-weight-bold text-xs text-warning" data-toggle="tooltip" data-original-title="Edit">
                        Edit
                      </a>
                    </td>
                    <td class="align-middle">
                      <button href="javascript:;" data-bs-toggle="modal" data-bs-target="#{{$question->id}}Modal" class="border-0 bg-white text-secondary font-weight-bold text-xs text-danger" data-toggle="tooltip" data-original-title="Delete">
                        Delete
                      </button>
                    </td>
                  </tr>
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
                @endforeach
              </tbody>
            </table>
            {{$questions->links('pagination::bootstrap-5')}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
