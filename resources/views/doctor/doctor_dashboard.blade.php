@extends('layouts.admin')
@section('header')
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Hospital Account</li>
            <li class="nav-item">

                <a class="nav-link " href="{{ route('doctor.dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>

            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                @if (auth()->user()->role === 'Admin')
                    <a class="nav-link collapsed" href="{{ route('admin.profile') }}">
                        <i class="bi bi-person"></i>
                        <span>Profile</span>
                    </a>
                @elseif(auth()->user()->role === 'Doctor')
                    <a class="nav-link collapsed" href="{{ route('doctor.profile') }}">
                        <i class="bi bi-person"></i>
                        <span>Profile</span>
                    </a>
                @endif
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                @if (auth()->user()->role === 'Admin')
                    <a class="nav-link collapsed" href="{{ route('admin.faq') }}">
                        <i class="bi bi-question-circle"></i>
                        <span>F.A.Q</span>
                    </a>
                @elseif(auth()->user()->role === 'Doctor')
                    <a class="nav-link collapsed" href="{{ route('doctor.faq') }}">
                        <i class="bi bi-question-circle"></i>
                        <span>F.A.Q</span>
                    </a>
                @endif
            </li><!-- End F.A.Q Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="mailto: pristian.dharmawan@binus.ac.id">
                    <i class="bi bi-envelope"></i>
                    <span>Contact Me</span>
                </a>
            </li><!-- End Contact Page Nav -->

            <li class="nav-heading">Hospital Data</li>
            <a class="nav-link collapsed" href="{{ route('doctor.doctor.table') }}">
                <i class="bi bi-table"></i><span>Doctor Data</span>
            </a>
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    @if (auth()->user()->role === 'Admin')
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    @elseif(auth()->user()->role === 'Doctor')
                        <li class="breadcrumb-item"><a href="{{ route('doctor.dashboard') }}">Home</a></li>
                    @endif
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <!-- Doctor Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Doctor</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-clipboard2-pulse"></i>
                                        </div>
                                        <div class="ps-3 d-flex align-items-center justify-content-center flex-grow-1">
                                            <h6 id="doctorValue" style="font-size: 28px"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Fetch data from the server
                                    fetch('/doctor/echarts')
                                        .then(response => response.json())
                                        .then(data => {
                                            const countDoctor = data.doctor ?? 0;
                                            const doctorValue = document.getElementById('doctorValue');
                                            doctorValue.textContent = countDoctor;
                                        })
                                        .catch(error => {
                                            // Handle the error if the fetch request fails
                                            console.error('Error:', error);
                                        });
                                });
                            </script>
                        </div><!-- End Doctor Card -->


                        <!-- Patient Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Patient</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-heart-pulse-fill"></i>
                                        </div>
                                        <div class="ps-3 d-flex align-items-center justify-content-center flex-grow-1">
                                            <h6 id="patientValue" style="font-size: 28px"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Fetch data from the server
                                    fetch('/doctor/echarts')
                                        .then(response => response.json())
                                        .then(data => {
                                            const countPatient = data.patient ?? 0;
                                            const patientValue = document.getElementById('patientValue');
                                            patientValue.textContent = countPatient;
                                        })
                                        .catch(error => {
                                            // Handle the error if the fetch request fails
                                            console.error('Error:', error);
                                        });
                                });
                            </script>
                        </div><!-- End Patient Card -->

                        <!-- Room Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Room</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-activity"></i>
                                        </div>
                                        <div class="ps-3 d-flex align-items-center justify-content-center flex-grow-1">
                                            <h6 id="roomValue" style="font-size: 28px"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Fetch data from the server
                                    fetch('/doctor/echarts')
                                        .then(response => response.json())
                                        .then(data => {
                                            const countRoom = data.room ?? 0;
                                            const roomValue = document.getElementById('roomValue');
                                            roomValue.textContent = countRoom;
                                        })
                                        .catch(error => {
                                            // Handle the error if the fetch request fails
                                            console.error('Error:', error);
                                        });
                                });
                            </script>
                        </div><!-- End Room Card -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-4">
                    <!-- Website Traffic -->
                    <div class="card">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Hospital Data</h5>

                            <div id="pieChart" style="min-height: 400px;" class="echart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    fetch('/doctor/echarts')
                                        .then(response => response.json())
                                        .then(data => {
                                            const chartData = [];

                                            if (data.doctor > 0) {
                                                chartData.push({
                                                    value: data.doctor,
                                                    name: 'Doctor'
                                                });
                                            }

                                            if (data.patient > 0) {
                                                chartData.push({
                                                    value: data.patient,
                                                    name: 'Patient'
                                                });
                                            }

                                            if (data.room > 0) {
                                                chartData.push({
                                                    value: data.room,
                                                    name: 'Room'
                                                });
                                            }

                                            // Initialize the chart
                                            echarts.init(document.querySelector("#pieChart")).setOption({
                                                tooltip: {
                                                    trigger: 'item'
                                                },
                                                legend: {
                                                    top: '5%',
                                                    left: 'center'
                                                },
                                                series: [{
                                                    name: 'Access From',
                                                    type: 'pie',
                                                    radius: '50%',
                                                    data: chartData,
                                                    emphasis: {
                                                        itemStyle: {
                                                            shadowBlur: 10,
                                                            shadowOffsetX: 0,
                                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                                        }
                                                    }
                                                }]
                                            });
                                        })
                                        .catch(error => {
                                            console.error('Error fetching data:', error);
                                        });
                                });
                            </script>
                        </div>
                    </div><!-- End Website Traffic -->
                </div><!-- End Right side columns -->
            </div>
        </section>

    </main><!-- End #main -->
@section('footer')
@endsection
@section('script')
@endsection
@endsection
