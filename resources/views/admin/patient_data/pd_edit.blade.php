@extends('layouts.pd_admin')
@section('header')
    <main id="main-add-patient" class="main-add-patient">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Patient Form</h5>

                <!-- Multi Columns Form -->
                <form action="{{ route('patientController.update', $patient->id) }}" method="POST"
                    class="row g-3 needs-validation" novalidate>
                    @csrf
                    @method('put')
                    <div class="col-md-12">
                        <label for="name" class="form-label">Patient Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $patient->name }}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide patient's name.
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $patient->phone }}" required
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ? true : false">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide patient's phone number or any relatives.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $patient->address }}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide patient's address.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $patient->dob }}"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input the date.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" class="form-select" name="gender">
                            <option value="M" {{ $patient->gender == 'M' ? 'selected' : '' }}>M</option>
                            <option value="F" {{ $patient->gender == 'F' ? 'selected' : '' }}>F</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="doctor" class="form-label">Doctor</label>
                        <select id="doctor" class="form-select" name="doctor">
                            @foreach ($doctor as $doctors)
                                <option value="{{ $doctors->id }}"
                                    {{ $doctors->id == $patient->doctor_id ? 'selected' : '' }}>
                                    {{ $doctors->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="room" class="form-label">Room</label>
                        <select id="room" class="form-select" name="room">
                            @foreach ($room as $rooms)
                                <option
                                    value="{{ $rooms->id }}
                            {{ old('room_id') == $rooms->id ? 'selected' : '' }}">
                                    {{ $rooms->room_type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 text-center" style="margin: 0 auto; margin-top: 16px">
                        <label for="payment" class="form-label">Total Payment</label>
                        <input type="type" for="payment" id="payment" name="payment" class="form-control"
                            value="{{ $patient->payment->full_amount }}" required
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ? true : false">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please input the total amount.
                        </div>
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
@endsection
@endsection
