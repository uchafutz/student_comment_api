@extends('laratrust::panel.layout')

@section('title', "{$title}")

@section('content')
    <div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-32">
            @isset($question)
                <form method="POST" action="{{ route('comment.questions.update', ['question' => $question]) }}">
                    @method('PATCH')
                @else
                    <form method="POST" action="{{ route('comment.questions.store') }}">
                    @endisset

                    @csrf

                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Question name</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="name" rows="3">{{ old('name') ?? isset($question) ? $question->name : '' }}</textarea>
                                </div>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="row">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Answers</label>
                                    <div class="flex flex-wrap justify-start mb-4">
                                        @foreach ($answers as $answer)
                                            <label class="inline-flex items-center mr-6 my-2 text-sm"
                                                style="flex: 1 0 20%;">
                                                <input type="checkbox" class="form-checkbox h-4 w-4" name="answer_id[]"
                                                    value="{{ $answer->getKey() }}" {!! isset($question) ? ($answer->question->contains($question->id) ? 'checked' : '') : '' !!}>
                                                <span class="ml-2">{{ $answer->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <a href="{{ route('comment.questions.index') }}" class="btn btn-red mr-4">
                                    Cancel
                                </a>
                                <button class="btn btn-blue" type="submit">Save</button>
                            </div>

                        </div>

                    </div>
                </form>



        </div>
    </div>
@endsection
