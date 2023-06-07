@extends('laratrust::panel.layout')

@section('title', "{$title}")

@section('content')
    <div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-32">
            @isset($faculty)
                <form method="POST" action="{{ route('facultys.update', ['faculty' => $faculty]) }}">
                    @method('PATCH')
                @else
                    <form method="POST" action="{{ route('facultys.store') }}">
                    @endisset

                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <label class="block">
                                <span class="text-gray-700">Name</span>
                                <input type="text" class="form-input mt-1 block w-full" name="name" placeholder="Name"
                                    value="{{ old('name') ?? isset($faculty) ? $faculty->name : '' }}">
                                 @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            </label>
                           
                             <label class="block">
                                <span class="text-gray-700">Departmnet</span>
                                <select name="department_id" class="form-input mt-1 block w-full">
                                    @foreach ($departments as $department )
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach

                                     @error('department_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                    
                                </select>
                               
                                

                            </label>
                           
                            <label class="block my-4">
                                <span class="text-gray-700">Description</span>
                                <textarea class="form-textarea mt-1 block w-full" rows="3" name="description"
                                    placeholder="Some description for the faculty">{{ old('description') ?? isset($faculty) ? $faculty->description : '' }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>



                            <div class="flex justify-end">
                                <a href="{{ route('facultys.index') }}" class="btn btn-red mr-4">
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
