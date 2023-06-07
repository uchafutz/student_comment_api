@extends('laratrust::panel.layout')

@section('title', "{$title}")

@section('content')
    <div class="flex flex-col"  x-data="getState()" x-init="initialize({{ json_encode($lectures) }}, {{ json_encode($departments) }}, {{ json_encode($modules) }})">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> {{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

            <div
                class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">

                <div class="card">
                    <form action="{{ route('comment.comments.store') }}" method="POST">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $student->id }}" />
                        <div class="card-body">
                            <div class="row">

                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Select Lecturer’s
                                    </label>
                                     <select name="lecture_id" x-model="form.lecture_id"
                                    class="form-control @error('department_id') is-invalid @enderror">
                                     <option value="">Choose...</option>
                                    <template x-for="lecture in lectures">
                                        <option x-bind:value="lecture.id" x-text="lecture.users.name">
                                        </option>
                                    </template>
                                     </select>

                                </div>
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">Select Course name</label>
                                   <select class="form-control" name='module_id' x-model='form.module_id'>
                                                <template x-for="module in form.modules">
                                                  <option x-bind:value="module.id" x-text="module.name">
                                                 </template>   
                                                </div>                                        
                                            </template>
                                           
                                        </select>
                                                   
                                </div>
                            </div>
                            <div class="p-4"></div>
                            <div class="row">
                                <label for="exampleFormControlTextarea1" class="form-label">How would you rate the teacher’s
                                    knowledge of the subject matter?</label>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" name="rates" type="radio" value="4"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Poor (4 Points)
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" name="rates" type="radio" value="5"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Moradate (6 Points)
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" name="rates" type="radio" value="10"
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Very good (10 points)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4"></div>
                            @foreach ($questions as $key => $question)
                                <div class="row">
                                    <input type="hidden" name="items[{{ $key }}][question_id]"
                                        value="{{ $question->id }}" />
                                    <label for="exampleFormControlTextarea1"
                                        class="form-label">{{ $question->name }}</label>
                                    <div class="flex flex-wrap justify-start mb-4">
                                        @foreach ($question->answer as $key => $answer)
                                            <label class="inline-flex items-center mr-6 my-2 text-sm"
                                                style="flex: 1 0 20%;">
                                                <input type="checkbox" class="form-checkbox h-4 w-4"
                                                    name="items[{{ $key }}][answer_id]"
                                                    value="{{ $answer->getKey() }}">
                                                <span class="ml-2">{{ $answer->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <div class="p-4"></div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="name" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="flex justify-end">
                                    <a href="{{ route('department.students.index') }}" class="btn btn-red mr-4">
                                        Cancel
                                    </a>
                                    <button class="btn btn-blue" type="submit">Save</button>
                                </div>

                            </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
<script>
    const initialForm = {

        modules: {},
        department_id: '',
        lecture_id: '',
        module_id: ''
    }

    function getState() {
        return {
            lectures: [],
            departments: [],
            modules: [],
            form: initialForm,
            initialize(lectures, departments, modules) {
                this.modules = modules;
                this.departments = departments;
                this.lectures = lectures;
                




                this.$watch('form.department_id', id => {

                })
                this.$watch('form.lecture_id', id => {
                  const _modules=this.lectures.find(u=> u.id== id);
                  console.log("the values",_modules.modules);
                  if(_modules.modules){
                    this.form.modules=_modules.modules;
                  }

                   console.log("the value of modules",this.form.modules);
                })
            },
        }
            console.log(lectures);

    }
    // console.log(lectures);

</script>