@section('title', 'Dashbord')
@extends('laratrust::panel.layout')
@section('content')
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="mt-4 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <div class="col-md-12">

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
