@extends('layouts.pd_admin')
@section('header')
    <main id="main-add-patient" class="main-add-patient">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Patient Form</h5>

                <!-- Multi Columns Form -->
                <form action="{{ route('patientController.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-12">
                        <label for="name" class="form-label">Patient Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="col-md-12">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            placeholder="Jl. Jaya Abadi">
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date" name="date">
                    </div>
                    <div class="col-md-2">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" class="form-select" name="gender">
                            <option selected>M</option>
                            <option>F</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="doctor" class="form-label">Doctor</label>
                        <select id="doctor" class="form-select" name="doctor">
                            @foreach ($doctor as $doctors)
                                <option
                                    value="{{ $doctors->id }}
                            {{ old('doctor_id') == $doctors->id ? 'selected' : '' }}">
                                    {{ $doctors->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger"><a href="{{ route('admin.patient.crud') }}"
                                style="color: white">Back</a></button>
                    </div>
                </form><!-- End Multi Columns Form -->

            </div>
        </div>
    </main>
@section('script')
