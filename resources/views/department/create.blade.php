@extends('laratrust::panel.layout')

@section('title', "{$title}")

@section('content')
    <div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-32">
            @isset($department)
                <form method="POST" action="{{ route('department.departments.update', ['department' => $department]) }}">
                    @method('PATCH')
                @else
                    <form method="POST" action="{{ route('department.departments.store') }}">
                    @endisset

                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <label class="block">
                                <span class="text-gray-700">Name</span>
                                <input type="text" class="form-input mt-1 block w-full" name="name" placeholder="Name"
                                    value="{{ old('name') ?? isset($department) ? $department->name : '' }}">

                            </label>
                            @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                            <label class="block my-4">
                                <span class="text-gray-700">Description</span>
                                <textarea class="form-textarea mt-1 block w-full" rows="3" name="description"
                                    placeholder="Some description for the department">{{ old('description') ?? isset($department) ? $department->description : '' }}</textarea>
                                @error('description')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </label>


                            <div class="flex justify-end">
                                <a href="{{ route('department.departments.index') }}" class="btn btn-red mr-4">
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
