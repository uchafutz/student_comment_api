@extends('laratrust::panel.layout')

@section('title', "{$title}")

@section('content')
    <div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-32">
            @isset($student)
                <form method="POST" action="{{ route('department.students.update', ['student' => $student]) }}">
                    @method('PATCH')
                @else
                    <form method="POST" action="{{ route('department.students.store') }}">
                    @endisset

                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <label class="block my-4">
                                <span class="text-gray-700">Student</span>
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
                                <span class="text-gray-700">Course</span>
                                <select name="course_id" class="form-input mt-1 block w-full" id="">

                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }}</option>
                                    @endforeach
                                </select>


                                @error('course_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label class="block my-4">
                                <span class="text-gray-700">Accademic Year</span>
                                <select name="accademic_year_id" class="form-input mt-1 block w-full" id="">

                                    @foreach ($years as $year)
                                        <option value="{{ $year->id }}"
                                            {{ old('accademic_year_id') == $year->id ? 'selected' : '' }}>
                                            {{ $year->accademic_year }}</option>
                                    @endforeach
                                </select>


                                @error('accademic_year_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>


                            <div class="flex justify-end">
                                <a href="{{ route('department.students.index') }}" class="btn btn-red mr-4">
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
