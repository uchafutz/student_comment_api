@extends('laratrust::panel.layout')

@section('title', 'Module')

@section('content')
    <div class="flex flex-col">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> {{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (config('laratrust.panel.create_permissions'))
            <a href="{{ route('course.modules.create') }}"
                class="self-end  hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                + New Module
            </a>
        @endif
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

            <div
                class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="th">Id</th>
                            <th class="th">Code</th>
                            <th class="th">Name</th>
                            <th class="th">credits</th>
                            <th class="th">Year</th>
                            <th class="th"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($modules as $module)
                            <tr>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $module->getKey() }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $module->code }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $module->name }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $module->credit }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $module->accademics->accademic_year }}
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('course.modules.edit', $module->getKey()) }}"
                                            class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <form action="{{ route('course.modules.destroy', $module->getKey()) }}"
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
    {{ $modules->links('laratrust::panel.pagination') }}
@endsection
