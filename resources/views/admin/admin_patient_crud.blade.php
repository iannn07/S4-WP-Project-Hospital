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
                    <i class="bi bi-hospital"></i><span>Patient Data</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin.patient.view') }}">
                            <i class="bi bi-circle"></i><span>View Patients</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.patient.crud') }}" class="active">
                            <i class="bi bi-circle"></i><span>Organize Patients</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Patient Data Organizer</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Patient Data Organizer</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Patient Data Organizer</h5>

                            <p>Click This Button below to add <b>New Patient</b></p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-start">
                                        <label class="btn btn-primary btn-md" title="Add New Data"
                                            style="margin-bottom: 16px">
                                            <a href="{{ route('patientController.create') }}">
                                                <i class="bi bi-plus-square upload-icon" style="margin-right: 8px"></i>
                                                <span style="color: white">Add Patient</span>
                                            </a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end">
                                        <form action="{{ route('admin.patient.truncate') }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-md" title="DELETE ALL RECORDS"
                                                style="margin-bottom: 16px"
                                                onclick="return confirm('Are you sure you want to delete all data?')">
                                                <i class="bi bi-trash-fill upload-icon" style="margin-right: 8px"></i>
                                                <span style="color: white">DELETE ALL RECORDS</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th class="col-1">ID</th>
                                        <th class="col-2">Name</th>
                                        <th class="col-2">Phone</th>
                                        <th class="col-2">Address</th>
                                        <th class="col-2">Total</th>
                                        <th class="col-2">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($patient as $patient_index)
                                        <tr>
                                            <td>{{ $patient_index->id }}</td>
                                            <td>{{ $patient_index->name }}</td>
                                            <td>{{ $patient_index->phone }}</td>
                                            <td>{{ $patient_index->address }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <span>Rp.</span>
                                                    <span class="d-flex justify-content-end" style="width: 150px;">{{ number_format($patient_index->payment->full_amount, 0, ',', '.') }}</span>
                                                  </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('patientController.edit', $patient_index->id) }}"
                                                        class="mx-2 btn btn-warning btn-sm" style="color: black"><i
                                                            class="bi bi-pencil"></i></a>
                                                    <form id="delete-journey"
                                                        action="{{ route('patientController.destroy', $patient_index->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="mx-2 btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this patient?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
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
