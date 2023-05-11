@section('title', 'Reports')
@extends('laratrust::panel.layout')
@section('content')
    <div class="flex flex-col" x-data="getState()" x-init="initialize({{ json_encode($lectures) }}, {{ json_encode($departments) }}, {{ json_encode($modules) }})">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <div class="col-md-12">
                    <div class="row">

                        <div class="col">
                            <div class="card">
                                <div class="card-header"><b>{{ __('Lecture Performance Report') }}</b><div class="ml-2"></div>
                                </div>

                                <div class="card-body">
                                    <form action="{{ route('report.reports.user') }}" method="POST">
                                        @csrf
                                    <div class="row">
                                    <div class="col">
                                    <div class="form-group">
                                    <label for="lecture_id" class="control-label">Choose Lecture</label>
                                     <select name="lecture_id" x-model="form.lecture_id"
                                    class="form-control @error('department_id') is-invalid @enderror">
                                    <option value="">Choose...</option>
                                    <template x-for="lecture in lectures">
                                        <option x-bind:value="lecture.id" x-text="lecture.users.name">
                                        </option>
                                    </template>

                                </select>
                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                           
                                        </div>
                                        <div class="col">
                                         <div class="form-group">
                                       <label for="department_id" class="control-label">Deparment</label>
                                           <select class="form-control" name="department_id" x-model="form.department_id" @readonly(true)>
                                           <template x-for="lecture in lectures.filter(u=>form.lecture_id ? u.id == form.lecture_id:'')">
                                          <option x-bind:value="lecture.departments.id" x-text="lecture.departments.name">
                                        </option>
                                        </template>
                                           </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                            <label for="module_id" class="control-label">Choose Module</label>
                                            <select class="form-control" name='module_id' x-model='form.module_id'>
                                                <template x-for="module in form.modules">
                                                  <option x-bind:value="module.id" x-text="module.name">
                                                 </template>   
                                                </div>                                        
                                            </template>
                                           
                                        </select>
                                                                                    
                                      
                                                 </div>

                                        </div>
                                        <div class="col">
                                             <div class="form-group">
                                            <label for="department_id" class="control-label">Accademic</label>
                                             <select class="form-control" name="year_id">
                                            
                                            @foreach ($years as $year )
                                                <option value="{{$year->id}}">{{$year->accademic_year}}</option>
                                            @endforeach
                                           </select>
                                             </div>
                                        </div>
                  
                                    </div>
                                    <div class="p-4"></div>
                                    <div class="row">
                                        <div class="col-md-8 offset-md-8">
                                    <button type="submit" class="btn btn-primary">Download</button>
                                    </div>

                                    </div>
                                    
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        
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