@section('title', 'Dashbord')
@extends('laratrust::panel.layout')
@section('content')
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6">
                            <div class="card widget-flat">
                                <div class="card-body p-0">
                                    <div class="p-3 pb-0">
                                        <div class="float-right">
                                            <i class="mdi mdi-cart text-primary widget-icon"></i>
                                        </div>
                                        <h5 class="text-muted font-weight-normal mt-0">Departments</h5>
                                        <h3 class="mt-2">{{ $department }}</h3>
                                    </div>
                                    <div id="sparkline1"></div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-xl-3 col-lg-6">
                            <div class="card widget-flat">
                                <div class="card-body p-0">
                                    <div class="p-3 pb-0">
                                        <div class="float-right">
                                            <i class="mdi mdi-currency-usd text-danger widget-icon"></i>
                                        </div>
                                        <h5 class="text-muted font-weight-normal mt-0">Courses</h5>
                                        <h3 class="mt-2">{{ $course }}</h3>
                                    </div>
                                    <div id="sparkline2"></div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-xl-3 col-lg-6">
                            <div class="card widget-flat">
                                <div class="card-body p-0">
                                    <div class="p-3 pb-0">
                                        <div class="float-right">
                                            <i class="mdi mdi-account-multiple text-primary widget-icon"></i>
                                        </div>
                                        <h5 class="text-muted font-weight-normal mt-0">Lecturers</h5>
                                        <h3 class="mt-2">{{ $lecture }}</h3>
                                    </div>
                                    <div id="sparkline3"></div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-xl-3 col-lg-6">
                            <div class="card widget-flat">
                                <div class="card-body p-0">
                                    <div class="p-3 pb-0">
                                        <div class="float-right">
                                            <i class="mdi mdi-eye-outline text-danger widget-icon"></i>
                                        </div>
                                        <h5 class="text-muted font-weight-normal mt-0">Student</h5>
                                        <h3 class="mt-2">{{ $student }}</h3>
                                    </div>
                                    <div id="sparkline4"></div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>

                    <div class="row">
                        <div class="p-4"></div>
                        <br />
                    </div>

                    <div class="row">
                        <canvas id="myChart" height="500px"></canvas>
                    </div>

                </div>

            </div>


            <script>
                const ctx = document.getElementById('myChart');
                var labels = {{ Js::from($labels) }};
                var users = {{ Js::from($data) }};
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '# Lectures Performarnce',
                            data: users,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        @endsection
