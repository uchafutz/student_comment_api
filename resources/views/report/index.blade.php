@section('title', 'Reports')
@extends('laratrust::panel.layout')
@section('content')
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">{{ __('User') }}<div class="ml-2"></div>
                                </div>

                                <div class="card-body">
                                    <a href="{{ route('report.reports.user') }}" class="btn btn-primary">Download Users</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">{{ __('Departments') }}</div>

                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">{{ __('Courses') }}</div>

                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">{{ __('Students') }}</div>

                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        @endsection
