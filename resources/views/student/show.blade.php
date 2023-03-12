@extends('laratrust::panel.layout')

@section('title', "{$title}")

@section('content')
    <div class="flex flex-col">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> {{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

            <div
                class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">

                <div class="card">
                    <form action="{{ route('comment.comments.store') }}" method="POST">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $student->id }}" />
                        <div class="card-body">
                            <div class="row">

                                <div class="col">
                                    <select class="form-select" name="lecture_id" aria-label="Default select example">
                                        @foreach ($lectures as $lecture)
                                            <option value="{{ $lecture->id }}">{{ $lecture->users->name }}</option>
                                        @endforeach


                                    </select>

                                </div>
                                <div class="col">
                                    <select class="form-select" name="module_id" aria-label="Default select example">
                                        @foreach ($modules as $module)
                                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                            <div class="p-4"></div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" name="rates" type="radio" value="4"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Poor (4 Points)
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" name="rates" type="radio" value="5"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Moradate (6 Points)
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" name="rates" type="radio" value="10"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Very good (10 points)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4"></div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="name" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="flex justify-end">
                                    <a href="{{ route('department.students.index') }}" class="btn btn-red mr-4">
                                        Cancel
                                    </a>
                                    <button class="btn btn-blue" type="submit">Save</button>
                                </div>

                            </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
