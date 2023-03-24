@extends('laratrust::panel.layout')

@section('title', "{$title}")

@section('content')
    <div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-32">
            @isset($answer)
                <form method="POST" action="{{ route('comment.answers.update', ['answer' => $answer]) }}">
                    @method('PATCH')
                @else
                    <form method="POST" action="{{ route('comment.answers.store') }}">
                    @endisset

                    @csrf

                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Answer name</label>
                                    <input type="text" value="{{ old('name') ?? isset($answer) ? $answer->name : '' }}"
                                        name="name" class="form-control" />

                                </div>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror


                            <div class="flex justify-end">
                                <a href="{{ route('comment.answers.index') }}" class="btn btn-red mr-4">
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
