@extends('laratrust::panel.layout')

@section('title', 'Accademic Year')

@section('content')
    <div class="flex flex-col">
        @if (Auth::user()->isAbleTo('year-create'))
            <a href="{{ route('department.years.create') }}"
                class="self-end  hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                + New Accademic Year
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
                            <th class="th">Accademic Year</th>
                            <th class="th"></th>
                            <th class="th">Status</th>
                            <th class="th"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($years as $year)
                            <tr>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $year->getKey() }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    {{ $year->accademic_year }}
                                </td>
                                <td class="td text-sm leading-5 text-gray-900">
                                    @if ($year->status == 0)
                                        <form action="{{ route('accadmic.year', $year->getKey()) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to set active year?');">
                                            @method('POST')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">SET ACTIVE</button>
                                        </form>
                                    @endif
                                </td>

                                <td class="td text-sm leading-5 text-gray-900">
                                    @if ($year->status == 0)
                                        <span class="badge bg-info text-dark">In Active</span>
                                    @else
                                        <span class="badge bg-success text-dark">Active</span>
                                    @endif

                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        @if (Auth::user()->isAbleTo('year-edit'))
                                            <a href="{{ route('department.years.edit', $year->getKey()) }}"
                                                class="text-blue-600 hover:text-blue-900">Edit</a>
                                        @endif
                                        @if (Auth::user()->isAbleTo('year-delete'))
                                            <form action="{{ route('department.years.destroy', $year->getKey()) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete the record?');">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $years->links('laratrust::panel.pagination') }}
@endsection
