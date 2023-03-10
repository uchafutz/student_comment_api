@extends('laratrust::panel.layout')

@section('title', "{$title}")

@section('content')
    <div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-32">
            @isset($lecture)
                <form method="POST" action="{{ route('department.lectures.update', ['lecture' => $lecture]) }}">
                    @method('PATCH')
                @else
                    <form method="POST" action="{{ route('department.lectures.store') }}">
                    @endisset

                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <label class="block my-4">
                                <span class="text-gray-700">Lecture</span>
                                <select name="user_id" class="form-input mt-1 block w-full" id="">

                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}</option>
                                    @endforeach
                                </select>


                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>


                            <label class="block my-4">
                                <span class="text-gray-700">Department</span>
                                <select name="department_id" class="form-input mt-1 block w-full" id="">

                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}</option>
                                    @endforeach
                                </select>


                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>


                            <div class="flex justify-end">
                                <a href="{{ route('department.lectures.index') }}" class="btn btn-red mr-4">
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
