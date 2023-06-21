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
                <a class="nav-link collapsed" href="{{ route('admin.doctor.table') }}">
                    <i class="bi bi-table"></i><span>Doctor Data</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-hospital"></i><span>Patient</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.patient.view') }}" class="active">
                            <i class="bi bi-circle"></i><span>View Patients</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.patient.crud') }}">
                            <i class="bi bi-circle"></i><span>Organize Patient</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Patient Data</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Patient Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Patient Data</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th class="col-1">ID</th>
                                        <th class="col-3">Name</th>
                                        <th class="col-3">PIC</th>
                                        <th class="col-4">Phone</th>
                                        <th class="col-1">Address</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 10px;">
                                    @foreach ($patient as $patient_index)
                                        <tr>
                                            <td>{{ $patient_index->id }}</td>
                                            <td>{{ $patient_index->name }}</td>
                                            <td>{{ $patient_index->doctor->name }}</td>
                                            <td>{{ $patient_index->phone }}</td>
                                            <td>{{ $patient_index->address }}</td>
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
