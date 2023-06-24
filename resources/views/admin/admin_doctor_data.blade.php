@extends('layouts.admin')
@section('header')
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Hospital Account</li>
            <li class="nav-item">

                <a class="nav-link collapsed" href="{{ route('admin.dashboard') }}">
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

            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.doctor.table') }}">
                    <i class="bi bi-table"></i><span>Doctor Data</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-hospital"></i><span>Patient Data</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.patient.view') }}">
                            <i class="bi bi-circle"></i><span>View Patients</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.patient.crud') }}">
                            <i class="bi bi-circle"></i><span>Organize Patients</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-dpad-fill"></i><span>Room Data</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="charts-nav" class="nav-content collapse collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.patient.view') }}">
                            <i class="bi bi-circle"></i><span>View Room-Patient</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.patient.crud') }}">
                            <i class="bi bi-circle"></i><span>Organize Room</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Doctor Data for Admin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Doctor Data for Admin</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Doctor Data for Admin</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th class="col-1">Doctor ID</th>
                                        <th class="col-3">Name</th>
                                        <th class="col-3">Email</th>
                                        <th class="col-3">License</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 10px;">
                                    @foreach ($doctor as $doctor_index)
                                        <tr>
                                            <td>{{ $doctor_index->id }}</td>
                                            <td>{{ $doctor_index->name }}</td>
                                            <td>{{ $doctor_index->email }}</td>
                                            <td>{{ $doctor_index->license }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@section('footer')
@endsection
@section('script')
@endsection
@endsection
