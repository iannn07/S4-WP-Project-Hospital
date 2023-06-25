@extends('layouts.admin')
@section('header')
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-heading">Hospital Account</li>
            <li class="nav-item">
                @if (auth()->user()->role === 'Admin')
                    <a class="nav-link collapsed" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                @elseif(auth()->user()->role === 'Doctor')
                    <a class="nav-link collapsed" href="{{ route('doctor.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                @endif
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

            @if (auth()->user()->role === 'Admin')
                <a class="nav-link " href="{{ route('admin.doctor.table') }}">
                    <i class="bi bi-table"></i><span>Doctor Data</span>
                </a>
            @elseif(auth()->user()->role === 'Doctor')
                <a class="nav-link " href="{{ route('doctor.doctor.table') }}">
                    <i class="bi bi-table"></i><span>Doctor Data</span>
                </a>
            @endif
        </ul>
    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Doctor Data for Doctor</h1>
            <nav>
                <ol class="breadcrumb">
                    @if (auth()->user()->role === 'Admin')
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    @elseif(auth()->user()->role === 'Doctor')
                        <li class="breadcrumb-item"><a href="{{ route('doctor.dashboard') }}">Home</a></li>
                    @endif
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
                                        <th class="col-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 10px;">
                                    @foreach ($doctor as $doctor_index)
                                        <tr>
                                            <td>{{ $doctor_index->id }}</td>
                                            <td>{{ $doctor_index->name }}</td>
                                            <td>{{ $doctor_index->email }}</td>
                                            <td>{{ $doctor_index->license }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('patientController.edit', $doctor_index->id) }}"
                                                        class="mx-2 btn btn-warning btn-sm" style="color: black"><i
                                                            class="bi bi-pencil"></i></a>
                                                    <form id="delete-journey"
                                                        action="{{ route('patientController.destroy', $doctor_index->id) }}"
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
