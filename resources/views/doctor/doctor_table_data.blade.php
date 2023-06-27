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
            <a class="nav-link " href="{{ route('doctor.doctor.table') }}">
                <i class="bi bi-table"></i><span>Doctor Data</span>
            </a>
            <a class="nav-link collapsed" href="{{ route('doctor.doctor.diagnosis') }}">
                <i class="bi bi-journal-medical"></i><span>Patient Diagnosis</span>
            </a>
        </ul>
    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Doctor Data for Doctor</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('doctor.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Doctor Data for Doctor</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Doctor Data for Doctor</h5>

                            {{-- Add New Data Button --}}
                            <div class="d-flex justify-content-start">
                                <label class="btn btn-primary btn-md" title="Add New Data" style="margin-bottom: 16px">
                                    <a href="{{ route('doctorController.create') }}">
                                        <i class="bi bi-plus-square upload-icon" style="margin-right: 8px"></i>
                                        <span style="color: white">Add Doctor</span>
                                    </a>
                                </label>
                            </div>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th class="col-1">Doctor ID</th>
                                        <th class="col-3">Name</th>
                                        <th class="col-3">Email</th>
                                        <th class="col-3">License</th>
                                        <th class="col-3">Patient Total</th>
                                        <th class="col-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 10px;">
                                    @forelse ($doctor as $doctor_index)
                                        <tr>
                                            <td>{{ $doctor_index->id }}</td>
                                            <td>{{ $doctor_index->name }}</td>
                                            <td>{{ $doctor_index->email }}</td>
                                            <td>{{ $doctor_index->license }}</td>
                                            <td>{{ $doctor_index->doctor_patient->count() }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('doctorController.edit', $doctor_index->id) }}"
                                                        class="mx-2 btn btn-warning btn-sm" style="color: black"><i
                                                            class="bi bi-pencil"></i></a>
                                                    <form id="delete-journey"
                                                        action="{{ route('doctorController.destroy', $doctor_index->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="mx-2 btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this patient?\n\nTHIS ACTION CANNOT BE UNDONE\n\nYou will delete {{ $doctor_index->name }} with the ID {{ $doctor_index->id }}')">
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
