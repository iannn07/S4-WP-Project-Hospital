@extends('layouts.pd_admin')
@section('header')
    <main id="main-add-patient" class="main-add-patient">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Patient Diagnosis Form</h5>

                <!-- Multi Columns Form -->
                <form action="{{ route('diagnosisController.update', $patient->id) }}" method="POST"
                    class="row g-3 needs-validation" novalidate>
                    @csrf
                    @method('put')
                    <div class="col-md-4">
                        <label for="name" class="form-label">Patient Name</label>
                        <p class="form-control">{{ $patient->name }}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <p class="form-control">{{ $patient->dob }}</p>
                    </div>
                    <div class="col-md-2">
                        <label for="gender" class="form-label">Gender</label>
                        <p class="form-control">{{ $patient->gender }}</p>
                    </div>
                    <div class="col-md-4">
                        <label for="room" class="form-label">Room</label>
                        <p class="form-control">{{ $patient->room->room_type }}</p>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label">Doctor Name</label>
                        <p class="form-control">{{ $patient->doctor->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label for="license" class="form-label">License</label>
                        <p class="form-control">{{ $patient->doctor->license }}</p>
                    </div>
                    <div class="col-md-6">
                        <label for="diagnosis" class="form-label">Diagnosis</label>
                        <input type="text" class="form-control" id="diagnosis" name="diagnosis"
                            value="{{ $patient->diagnosis->diagnosis }}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide an ICD.
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="description" class="col-sm-2 col-form-label form-label">Diagnosis Description</label>
                        <textarea class="form-control" style="height: 100px" id="description" name="description">{{ $patient->diagnosis ? $patient->diagnosis->diagnosis_description : 'N/A' }}</textarea>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please describe the patient disease.
                        </div>
                    </div>
                    <br>
                    <div class="text-center" style="margin-top: 16px">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger"><a href="{{ route('doctor.doctor.diagnosis') }}"
                                style="color: white">Back</a></button>
                    </div>
                </form><!-- End Multi Columns Form -->

            </div>
        </div>
    </main>
@section('script')
@endsection
@endsection
