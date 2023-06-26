@extends('layouts.pd_admin')
@section('header')
    <main id="main-add-patient" class="main-add-patient">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Doctor Form</h5>

                <!-- Multi Columns Form -->
                <form action="{{ route('doctorController.store') }}" method="POST" class="row g-3 needs-validation"
                    novalidate>
                    @csrf
                    <div class="col-md-6">
                        <label for="name" class="form-label">Doctor Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe">
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide your name.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="license" class="form-label">License</label>
                        <input type="text" class="form-control" id="license" name="license" placeholder="2571544202"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ? true : false" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide your license number.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="someone@example.com" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide your email address.
                        </div>
                    </div>
                    <br>
                    <div class="text-center" style="margin-top: 16px">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger"><a href="{{ route('doctor.doctor.table') }}"
                                style="color: white">Back</a></button>
                    </div>
                </form><!-- End Multi Columns Form -->

            </div>
        </div>
    </main>
@section('script')
@endsection
@endsection
