@extends('laratrust::panel.layout')

@section('title', "{$course->name}")

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

                <div class="card-body">
                    <div class="card-header">COURSE CODE::<b>{{ $course->code }}</b></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-3" style="max-width: 540px;">
                                            <div class="row g-0">

                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title"> {{ $course->departments->name }}
                                                        </h5>
                                                        <hr />
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">
                                                                <p>{{ $course->credits }}</p>
                                                            </li>

                                                            <li class="list-group-item">
                                                                <button type="button" class="btn btn-primary">
                                                                    Modules <span
                                                                        class="badge bg-danger">{{ $course->modules->count() }}</span>
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <form method="POST" action="{{ route('course.assign', ['course' => $course]) }}">
                                            @method('POST')
                                            @csrf
                                            <span class="block text-gray-700 mt-4">Modules</span>
                                            <div class="flex flex-wrap justify-start mb-4">
                                                <table class="table table-bordered">
                                                    @foreach ($modules as $module)
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <tr>
                                                                    <td> <label
                                                                            class="inline-flex items-center mr-6 my-2 text-sm"
                                                                            style="flex: 1 0 20%;">
                                                                            <input type="checkbox"
                                                                                class="form-checkbox h-4 w-4"
                                                                                name="module_id[]"
                                                                                value="{{ $module->getKey() }}"
                                                                                {!! $course->modules->contains($module->id) ? 'checked' : '' !!}>

                                                                        </label></td>
                                                                    <td><span>{{ $module->name }}</span></td>
                                                                </tr>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </table>
                                                {{ $modules->links('laratrust::panel.pagination') }}

                                            </div>

                                            <div class="flex justify-end">
                                                <a href="{{ route('course.courses.index') }}" class="btn btn-red mr-4">
                                                    Cancel
                                                </a>
                                                <button class="btn btn-blue" type="submit">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        @endsection
