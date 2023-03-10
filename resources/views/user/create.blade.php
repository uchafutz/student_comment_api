@extends('laratrust::panel.layout')

@section('title', "{$title}")

@section('content')
    <div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-32">
            @isset($user)
                <form method="POST" action="{{ route('user.users.update', ['user' => $user]) }}">
                    @method('PATCH')
                @else
                    <form method="POST" action="{{ route('user.users.store') }}">
                    @endisset

                    @csrf

                    <div class="card">
                        <div class="card-body">
                            <label class="block">

                                <span class="text-gray-700">Name.</span>
                                <input type="text" class="form-input mt-1 block w-full" name="name" placeholder="Name"
                                    value="{{ old('name') ?? isset($user) ? $user->name : '' }}">

                            </label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label class="block">

                                <span class="text-gray-700">Email.</span>
                                <input type="email" class="form-input mt-1 block w-full" name="email"
                                    placeholder="Email" value="{{ old('name') ?? isset($user) ? $user->email : '' }}">

                            </label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label class="block my-4">
                                <span class="text-gray-700">Phone</span>
                                <input type="number" class="form-input mt-1 block w-full" name="phone"
                                    placeholder="Phone" value="{{ old('phone') ?? isset($user) ? $user->phone : '' }}">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label class="block my-4">
                                <span class="text-gray-700">Type</span>
                                <select name="type" class="form-input mt-1 block w-full" id="">
                                    <option value="staff">STAFF</option>
                                    <option value="student">STUDENT</option>

                                </select>


                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>


                            <div class="flex justify-end">
                                <a href="{{ route('user.users.index') }}" class="btn btn-red mr-4">
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
