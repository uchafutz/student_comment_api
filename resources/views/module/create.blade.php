@extends('laratrust::panel.layout')

@section('title', "{$title}")

@section('content')
    <div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-32">
            @isset($module)
                <form method="POST" action="{{ route('course.modules.update', ['module' => $module]) }}">
                    @method('PATCH')
                @else
                    <form method="POST" action="{{ route('course.modules.store') }}">
                    @endisset

                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <label class="block">

                                <span class="text-gray-700">Name.</span>
                                <input type="text" class="form-input mt-1 block w-full" name="name" placeholder="Name"
                                    value="{{ old('name') ?? isset($module) ? $module->name : '' }}">

                            </label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label class="block my-4">
                                <span class="text-gray-700">Credits</span>
                                <input type="number" class="form-input mt-1 block w-full" name="credit"
                                    placeholder="Credits"
                                    value="{{ old('credit') ?? isset($module) ? $module->credit : '' }}">

                                @error('credit')
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
                                <a href="{{ route('course.modules.index') }}" class="btn btn-red mr-4">
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
