@extends('laratrust::panel.layout')

@section('title', 'Comment')

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
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="th">Id</th>
                            <th class="th">Comment</th>
                            <th class="th">Points</th>
                            <th class="th">Student</th>
                            <th class="th">Lecture</th>
                            <th class="th">Course</th>
                            <th class="th"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($comments as $comment)
                            <tr>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $comment->getKey() }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $comment->name }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $comment->rates }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $comment->students->users->name }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $comment->lectures->users->name }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $comment->modules->name }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    <div class="btn-group" role="group" aria-label="Basic example">

                                        <div class="p-3"></div>
                                        <form action="{{ route('comment.comments.destroy', $comment->getKey()) }}"
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
    {{ $comments->links('laratrust::panel.pagination') }}
@endsection
