@extends('laratrust::panel.layout')

@section('title', 'Course')

@section('content')
    <div class="flex flex-col">
        @if (config('laratrust.panel.create_permissions'))
            <a href="{{ route('course.courses.create') }}"
                class="self-end  hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                + New Course
            </a>
        @endif
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong> {{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div
                class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="th">Id</th>
                            <th class="th">Code</th>
                            <th class="th">Name</th>
                            <th class="th">credits</th>
                            <th class="th">Department</th>
                            <th class="th">No Modules</th>
                            <th class="th"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($courses as $course)
                            <tr>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $course->getKey() }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $course->code }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $course->name }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $course->credits }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $course->departments->name }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $course->modules->count() }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('course.courses.edit', $course->getKey()) }}"
                                            class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <div class="p-3"></div>
                                        <a href="{{ route('course.courses.show', $course->getKey()) }}"
                                            class="text-success hover:text-success">Show</a>
                                        <form action="{{ route('course.courses.destroy', $course->getKey()) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete the record?');">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $courses->links('laratrust::panel.pagination') }}
@endsection
