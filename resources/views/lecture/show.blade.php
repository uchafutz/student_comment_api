@extends('laratrust::panel.layout')

@section('title', "{$lecture->users->name}")

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
                    <div class="card-header">LECTURE ID::<b>{{ $lecture->lectureID }}</b></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    DEPARTMENT::<b>{{ $lecture->departments->name }} </b>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col">EMAIL::<b>{{ $lecture->users->email }}</b></div>
                                    <div class="col">PHONE::<b>{{ $lecture->users->phone }}</b></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form>
                                    <span class="block text-gray-700 mt-4">Modules</span>
                                    <div class="flex flex-wrap justify-start mb-4">
                                        @foreach ($modules as $module)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="inline-flex items-center mr-6 my-2 text-sm"
                                                        style="flex: 1 0 20%;">
                                                        <input type="checkbox" class="form-checkbox h-4 w-4"
                                                            name="module_id[]" value="{{ $module->getKey() }}">
                                                        <span class="ml-2">{{ $module->name }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="flex justify-end">
                                        <a href="{{ route('department.lectures.index') }}" class="btn btn-red mr-4">
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

    @endsection
