@extends('layouts.admin')
@section('header')
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Hospital Account</li>
            <li class="nav-item">

                <a class="nav-link collapsed" href="{{ route('doctor.dashboard') }}">
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
            <a class="nav-link " href="{{ route('doctor.doctor.diagnosis') }}">
                <i class="bi bi-journal-medical"></i><span>Patient Diagnosis</span>
            </a>
        </ul>
    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Patient Data for Doctor</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('doctor.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Patient Data for Doctor</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Patient Data for Doctor</h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th class="col-1">ID</th>
                                        <th class="col-3">Name</th>
                                        <th class="col-3">PIC</th>
                                        <th class="col-3">Diagnosis</th>
                                        <th class="col-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 10px;">
                                    @forelse ($patient as $patient_index)
                                        <tr>
                                            <td>{{ $patient_index->id }}</td>
                                            <td>{{ $patient_index->name }}</td>
                                            <td>{{ $patient_index->doctor->name }}</td>
                                            <td>{{ $patient_index->diagnosis->diagnosis }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    @if ($patient_index->diagnosis->diagnosis !== 'N/A')
                                                        <a href="{{ route('diagnosisController.edit', $patient_index->id) }}"
                                                            class="mx-2 btn btn-warning btn-sm" style="color: black">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('diagnosisController.edit', $patient_index->id) }}"
                                                            class="mx-2 btn btn-primary btn-sm" style="color: black">
                                                            <i class="bi bi-plus-square upload-icon"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%" align="center" style="font-size: 16px">No Data</td>
                                        </tr>
                                    @endforelse
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
