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
                        <a href="{{ route('admin.patient.view') }}" class="active">
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
                        <a href="{{ route('admin.room.view') }}">
                            <i class="bi bi-circle"></i><span>View Room-Patient</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.room.crud') }}">
                            <i class="bi bi-circle"></i><span>Organize Room</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <div class="row justify-content-center">
            <div class="col-lg-6 align-self-center">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Patient Details</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Patient Name</label>
                                <p class="form-control" style="text-align: center">{{ $patient->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="doctor" class="form-label">Doctor</label>
                                <p class="form-control" style="text-align: center">{{ $patient->doctor->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <p class="form-control" style="text-align: center">{{ $patient->gender }}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="date" class="form-label">Date of Birth</label>
                                <p class="form-control" style="text-align: center">{{ $patient->dob }}</p>
                            </div>
                            <div class="col-md-12">
                                <label for="phone" class="form-label">Phone</label>
                                <p class="form-control">{{ $patient->phone }}</p>
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <p class="form-control">{{ $patient->address }}</p>
                            </div>
                            <div class="col-md-6 text-center" style="margin: 0 auto;">
                                <label for="payment" class="form-label">Total Payment</label>
                                <p class="form-control">
                                    <span>Rp. </span>
                                    <span>{{ number_format($patient->payment->full_amount, 0, ',', '.') }}</span>
                                </p>
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="reset" class="btn btn-secondary"><a
                                        href="{{ route('admin.patient.view') }}" style="color: white">Back</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@section('footer')
@endsection
@section('script')
@endsection
@endsection
