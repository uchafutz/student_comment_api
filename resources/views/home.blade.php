@section('title', 'Dashbord')
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
                                <div class="card-header">{{ __('Lectures') }}<div class="ml-2">{{ $lectures }}</div>
                                </div>

                                <div class="card-body">
                                    <a href="{{ route('department.lectures.index') }}" class="btn btn-secondary">Lecture</a>
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
                    <div class="row">
                        <canvas id="myChart" height="100px"></canvas>
                    </div>

                </div>

            </div>
        @endsection

        <script type="text/javascript">
            var labels = {{ Js::from($labels) }};
            var users = {{ Js::from($data) }};

            const data = {
                labels: labels,
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: users,
                }]
            };

            const config = {
                type: 'line',
                data: data,
                options: {}
            };

            const myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        </script>
