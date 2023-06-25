@extends('layouts.pd_admin')
@section('header')
    <main id="main-add-patient" class="main-add-patient">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Room Form</h5>

                <!-- Multi Columns Form -->
                <form action="{{ route('roomController.update', $room->id) }}" method="POST" class="row g-3 needs-validation"
                    novalidate>
                    @csrf
                    @method('put')
                    <div class="col-md-12">
                        <label for="name" class="form-label">Room Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $room->room_type }}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please provide room name.
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger"><a href="{{ route('admin.room.crud') }}"
                                style="color: white">Back</a></button>
                    </div>
                </form><!-- End Multi Columns Form -->

            </div>
        </div>
    </main>
@section('script')
@endsection
@endsection
