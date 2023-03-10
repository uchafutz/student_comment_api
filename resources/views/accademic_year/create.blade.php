@extends('laratrust::panel.layout')

@section('title', "{$title}")

@section('content')
    <div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-32">
            @isset($year)
                <form method="POST" action="{{ route('department.years.update', ['year' => $year]) }}">
                    @method('PATCH')
                @else
                    <form method="POST" action="{{ route('department.years.store') }}">
                    @endisset

                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <label class="block">
                                <span class="text-gray-700">Accademic Year</span>
                                <input type="text" class="form-input mt-1 block w-full" name="accademic_year"
                                    placeholder="2021-2022"
                                    value="{{ old('accademic_year') ?? isset($year) ? $year->accademic_year : '' }}">

                            </label>
                            @error('accademic_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror



                            <div class="flex justify-end">
                                <a href="{{ route('department.years.index') }}" class="btn btn-red mr-4">
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
