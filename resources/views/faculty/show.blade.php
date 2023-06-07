@extends('laratrust::panel.layout')

@section('title', "Assign Faculty Programme")

@section('content')
  <div>
  </div>
  <div class="flex flex-col">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-32">
      <form
        method="POST"
        action="{{route('faculty.assign',['faculty'=>$faculty->id])}}"
        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 p-8"
      >
         @method('POST')
         @csrf
        <label class="block">
          <span class="text-gray-700">Faculty Name</span>
          <input
            class="form-input mt-1 block w-full bg-gray-200 text-gray-600"
            name="name"
            placeholder="this-will-be-the-code-name"
            value="{{$faculty->name ?? 'The model doesn\'t have a `name` attribute'}}"
            readonly
            autocomplete="off"
          >
        </label>
       
          <span class="block text-gray-700 mt-4">Programmes</span>
          <div class="flex flex-wrap justify-start mb-4">
            @foreach ($programmes as $programme)
              <label class="inline-flex items-center mr-6 my-2 text-sm" style="flex: 1 0 20%;">
                <input
                  type="checkbox"
                  class="form-checkbox h-4 w-4"
                  name="programme_id[]"
                  value="{{$programme->getKey()}}"
                 
                  {!! $faculty->programme->contains($programme->id) ? 'checked' : '' !!}
                >
                <span class="ml-2">{{$programme->name ?? $programme->name}}</span>
              </label>
            @endforeach
          </div>
        
        <div class="flex justify-end">
          <a
            href="{{route("facultys.index")}}"
            class="btn btn-red mr-4"
          >
            Cancel
          </a>
          <button class="btn btn-blue" type="submit">Save</button>
        </div>
      </form>
    </div>
  </div>
@endsection